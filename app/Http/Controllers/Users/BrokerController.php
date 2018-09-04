<?php

namespace App\Http\Controllers\Users;

use App\Helpers\Thumbnail;
use App\Http\Controllers\UserController;
use App\Http\Requests\InviteRequest;
use App\Http\Requests\BrokerRequest;
use App\Mail\InviteBroker;
use App\Repositories\InviteUserRepository;
use App\Repositories\UserRepository;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Efriandika\LaravelSettings\Facades\Settings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Yajra\Datatables\Datatables;

class BrokerController extends UserController
{
    private $date_format = 'd-m-Y';
    private $emailSettings;
    private $siteNameSettings;
    /**
     * @var UserRepository
     */
    private $userRepository;
    /**
     * @var InviteUserRepository
     */
    private $inviteUserRepository;

    /**
     * BrokerController constructor.
     * @param UserRepository $userRepository
     * @param InviteUserRepository $inviteUserRepository
     */
    public function __construct(UserRepository $userRepository,
            InviteUserRepository $inviteUserRepository)
    {

        $this->middleware('authorized:broker.read', ['only' => ['index', 'data']]);
        $this->middleware('authorized:broker.write', ['only' => ['create', 'store', 'update', 'edit']]);
        $this->middleware('authorized:broker.delete', ['only' => ['delete']]);

        parent::__construct();
        $this->userRepository = $userRepository;
        $this->inviteUserRepository = $inviteUserRepository;
        $this->date_format = config('settings.date_format');
        $this->emailSettings = Settings::get('site_email');
        $this->siteNameSettings = Settings::get('site_name');

        view()->share('type', 'broker');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = trans('broker.brokers');
        return view('user.broker.index', compact('title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = trans('broker.new');
        return view('user.broker.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param BrokerRequest|Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(BrokerRequest $request)
    {
        if ($request->hasFile('user_avatar_file')) {
            $file = $request->file('user_avatar_file');
            $file = $this->userRepository->uploadAvatar($file);

            $request->merge([
                'user_avatar' => $file->getFileInfo()->getFilename(),
            ]);

            $this->generateThumbnail($file);
        }

        $user = Sentinel::registerAndActivate($request->only('first_name', 'last_name', 'email', 'password'));

        $role = Sentinel::findRoleBySlug('broker');
        $role->users()->attach($user);

        $user = $this->userRepository->find($user->id);

        foreach ($request->get('permissions', []) as $permission) {
            $user->addPermission($permission);
        }

        $user->user_id = $this->user->id;
        $user->phone_number = $request->phone_number;
        $user->user_avatar = $request->user_avatar;
        $user->user_type = $request->user_type;
        $user->save();

        return redirect("broker");
    }


    public function edit($broker)
    {
        $broker = $this->userRepository->find($broker);
        if ($broker->id == '1') {
            return redirect('broker');
        } else {
            $title = trans('broker.edit');
            return view('user.broker.edit', compact('title', 'broker'));
        }
    }


    public function update(BrokerRequest $request, $broker)
    {
        $broker = $this->userRepository->find($broker);
        if ($request->password != "") {
            $broker->password = bcrypt($request->password);
        }

        if ($request->hasFile('user_avatar_file')) {
            $file = $request->file('user_avatar_file');
            $file = $this->userRepository->uploadAvatar($file);

            $request->merge([
                'user_avatar' => $file->getFileInfo()->getFilename(),
            ]);

            $this->generateThumbnail($file);

        } else {
            $request->merge([
                'user_avatar' => $broker->user_avatar,
            ]);
        }

        foreach ($broker->getPermissions() as $key => $item) {
            $broker->removePermission($key);
        }

        foreach ($request->get('permissions', []) as $permission) {
            $broker->addPermission($permission);
        }

        $broker->first_name = $request->first_name;
        $broker->last_name = $request->last_name;
        $broker->phone_number = $request->phone_number;
        $broker->email = $request->email;
        $broker->user_avatar = $request->user_avatar;
        $broker->save();

        return redirect("broker");
    }

    public function show($broker)
    {
        $broker = $this->userRepository->find($broker);
        $title = trans('broker.show_broker');
        $action = "show";
        return view('user.broker.show', compact('title', 'broker','action'));
    }

    public function delete($broker)
    {
        $broker = $this->userRepository->find($broker);
        $title = trans('broker.delete_broker');
        return view('user.broker.delete', compact('title', 'broker'));
    }


    public function destroy($broker)
    {
        $broker = $this->userRepository->find($broker);
        if ($broker->id != '1') {
            $broker->delete();
        }
        return redirect('broker');
    }


    public function data(Datatables $datatables)
    {
        $dateFormat = config('settings.date_format');
        $brokers = $this->userRepository->getAllNew()->with('brokerSalesTeam')
            ->get()
            ->filter(function ($user) {
                return ($user->inRole('broker') && $user->id!=$this->user->id);
            })->map(function ($user) use ($dateFormat){
                return [
                    'id' => $user->id,
                    'full_name' => $user->full_name,
                    'email' => $user->email,
                    'created_at' => date($dateFormat,strtotime($user->created_at)),
                    'count_uses' => $user->brokerSalesTeam->count()
                ];
            });

        return $datatables->collection($brokers)
            ->addColumn('actions', '@if(Sentinel::getUser()->hasAccess([\'broker.write\']) || Sentinel::inRole(\'admin\'))
                                        <a href="{{ url(\'broker/\' . $id . \'/edit\' ) }}" title="{{ trans(\'table.edit\') }}">
                                            <i class="fa fa-fw fa-pencil text-warning"></i> </a>
                                     @endif
                                     <a href="{{ url(\'broker/\' . $id . \'/show\' ) }}" title="{{ trans(\'table.details\') }}" >
                                            <i class="fa fa-fw fa-eye text-primary"></i> </a>
                                     @if(Sentinel::getUser()->hasAccess([\'broker.delete\']) || Sentinel::inRole(\'admin\') && $count_uses==0)
                                        <a href="{{ url(\'broker/\' . $id . \'/delete\' ) }}" title="{{ trans(\'table.delete\') }}">
                                            <i class="fa fa-fw fa-trash text-danger"></i> </a>
                                      @endif')
            ->removeColumn('id')
            ->removeColumn('count_uses')
            ->rawColumns(['actions'])->make();
    }

    /**
     * @param $file
     */
    private function generateThumbnail($file)
    {
        Thumbnail::generate_image_thumbnail(public_path() . '/uploads/avatar/' . $file->getFileInfo()->getFilename(),
            public_path() . '/uploads/avatar/' . 'thumb_' . $file->getFileInfo()->getFilename());
    }


    public function invite()
    {
        $title = trans('broker.invite_brokers');
        $date_format = config('settings.date_format');
        return view('user.broker.invite', compact('title','date_format'));
    }

    public function inviteSave(InviteRequest $request)
    {
        if (filter_var($this->emailSettings, FILTER_VALIDATE_EMAIL)) {
            $emails = array_filter(array_unique(explode(';', $request->emails)));

            foreach ($emails as $key => $email) {
                $this->inviteUserRepository->deleteWhere([
                    'claimed_at' => null,
                    'email' => $email,
                ]);
                $user_email = $this->userRepository->usersWithTrashed($email)->count();
                if (0 == $user_email) {
                    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                        $invite = $this->inviteUserRepository->createInvite(['email' => trim($email)]);
                        $inviteUrl = url('invite/'.$invite->code);
                        Mail::to($email)->send(new InviteBroker([
                            'from' => $this->emailSettings,
                            'subject' => 'Invite to '.$this->siteNameSettings,
                            'inviteUrl' => $inviteUrl,
                        ]));
                    } else {
                        flash(trans('Email '.$email.' is not valid.'))->error();
                    }
                } else {
                    flash(trans('Email '.$email.' is already taken.'))->error();
                }
            }
        } else {
            flash(trans('broker.invalid-email'))->error();
        }

        return redirect('broker/invite');
    }

    public function inviteCancel($id)
    {
        $title = trans('broker.invite_cancel');

        $invite = $this->inviteUserRepository->findWhere([
            'id' => $id,
        ])->first();

        return view('user.broker.invite-cancel', compact('title', 'invite'));
    }

    public function inviteCancelConfirm($id)
    {
        $this->inviteUserRepository->deleteWhere([
            'id' => $id,
            'claimed_at' => null,
        ]);

        return redirect('broker/invite');
    }
}
