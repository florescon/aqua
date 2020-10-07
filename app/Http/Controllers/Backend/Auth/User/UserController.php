<?php

namespace App\Http\Controllers\Backend\Auth\User;

use App\Models\Auth\User;
use App\Http\Controllers\Controller;
use App\Events\Backend\Auth\User\UserDeleted;
use App\Repositories\Backend\Auth\RoleRepository;
use App\Repositories\Backend\Auth\UserRepository;
use App\Repositories\Backend\Auth\PermissionRepository;
use App\Repositories\Backend\BloodRepository;
use App\Repositories\Backend\SchoolRepository;
use App\Http\Requests\Backend\Auth\User\StoreUserRequest;
use App\Http\Requests\Backend\Auth\User\StoreCustomerRequest;
use App\Http\Requests\Backend\Auth\User\ManageUserRequest;
use App\Http\Requests\Backend\Auth\User\UpdateUserRequest;
use App\Blood;
use App\Customer;
use DataTables;
use Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\DataTables\UserDataTable;

/**
 * Class UserController.
 */
class UserController extends Controller
{
    /**
     * @var UserRepository
     */
    protected $userRepository;

    /**
     * UserController constructor.
     *
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param ManageUserRequest $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(ManageUserRequest $request)
    {
        return view('backend.auth.user.index')
            ->withUsers($this->userRepository->getActivePaginated(25, 'id', 'asc'));
    }



    /**
     * @param ManageUserRequest $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function indexCustomer(UserDataTable $dataTable)
    {

        return $dataTable->render('backend.customer.index');

    }

    /**
     * @param ManageUserRequest    $request
     * @param RoleRepository       $roleRepository
     * @param PermissionRepository $permissionRepository
     *
     * @return mixed
     */
    public function create(ManageUserRequest $request, RoleRepository $roleRepository, PermissionRepository $permissionRepository, BloodRepository $bloodRepository)
    {
        return view('backend.auth.user.create')
            ->withRoles($roleRepository->with('permissions')->get(['id', 'name']))
            ->withBloods($bloodRepository->get(['id', 'name']))
            ->withPermissions($permissionRepository->get(['id', 'name']));
    }




    /**
     * @param Request    $request
     * @param RoleRepository       $roleRepository
     * @param PermissionRepository $permissionRepository
     *
     * @return mixed
     */
    public function createCustomer(Request $request, RoleRepository $roleRepository, PermissionRepository $permissionRepository, BloodRepository $bloodRepository)
    {
        return view('backend.customer.create')
            ->withRoles($roleRepository->with('permissions')->get(['id', 'name']))
            ->withBloods($bloodRepository->get(['id', 'name']))
            ->withPermissions($permissionRepository->get(['id', 'name']));
    }

    /**
     * @param StoreUserRequest $request
     *
     * @throws \Throwable
     * @return mixed
     */
    public function store(StoreUserRequest $request)
    {
        $this->userRepository->create($request->only(
            'first_name',
            'last_name',
            'email',
            'password',
            'phone',
            'age',
            'address',
            'blood',
            'school',
            'grade',
            'ins',
            'active',
            'confirmed',
            'confirmation_email',
            'roles',
            'permissions'
        ));

        return redirect()->route('admin.auth.user.index')->withFlashSuccess(__('alerts.backend.users.created'));
    }

    /**
     * @param Request $request
     *
     * @throws \Throwable
     * @return mixed
     */
    public function storeCustomer(StoreCustomerRequest $request)
    {
        $this->userRepository->createCustomer($request->only(
            'first_name',
            'last_name',
            'email',
            'password',
            'phone',
            'age',
            'address',
            'blood',
            'school',
            'grade',
            'ins',
            'active',
            'confirmed',
            'confirmation_email',
            'roles',
            'permissions'
        ));

        return redirect()->route('admin.customer.index')->withFlashSuccess(__('alerts.backend.users.created'));
    }

    /**
     * @param ManageUserRequest $request
     * @param User              $user
     *
     * @return mixed
     */
    public function show(ManageUserRequest $request, User $user)
    {
        return view('backend.auth.user.show')
            ->withUser($user);
    }

    /**
     * @param ManageUserRequest $request
     * @param User              $user
     *
     * @return mixed
     */
    public function showCustomer(Request $request, User $user)
    {
        return view('backend.customer.show')
            ->withUser($user);
    }


    /**
     * @param ManageUserRequest    $request
     * @param RoleRepository       $roleRepository
     * @param PermissionRepository $permissionRepository
     * @param User                 $user
     *
     * @return mixed
     */
    public function edit(ManageUserRequest $request, RoleRepository $roleRepository, PermissionRepository $permissionRepository,  BloodRepository $bloodRepository, SchoolRepository $schoolRepository, User $user)
    {
        return view('backend.auth.user.edit')
            ->withUser($user)
            ->withRoles($roleRepository->get())
            ->withUserRoles($user->roles->pluck('name')->all())
            ->withBloods($bloodRepository->get(['id', 'name']))
            ->withSchools($schoolRepository->get(['id', 'name']))
            ->withPermissions($permissionRepository->get(['id', 'name']))
            ->withUserPermissions($user->permissions->pluck('name')->all());
    }


    /**
     * @param Request    $request
     * @param RoleRepository       $roleRepository
     * @param PermissionRepository $permissionRepository
     * @param User                 $user
     *
     * @return mixed
     */
    public function editCustomer(Request $request, RoleRepository $roleRepository, PermissionRepository $permissionRepository,  BloodRepository $bloodRepository, SchoolRepository $schoolRepository, User $user)
    {
        return view('backend.customer.edit')
            ->withUser($user)
            ->withRoles($roleRepository->get())
            ->withUserRoles($user->roles->pluck('name')->all())
            ->withBloods($bloodRepository->get(['id', 'name']))
            ->withSchools($schoolRepository->get(['id', 'name']))
            ->withPermissions($permissionRepository->get(['id', 'name']))
            ->withUserPermissions($user->permissions->pluck('name')->all());
    }

    /**
     * @param UpdateUserRequest $request
     * @param User              $user
     *
     * @throws \App\Exceptions\GeneralException
     * @throws \Throwable
     * @return mixed
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $this->userRepository->update($user, $request->only(
            'first_name',
            'last_name',
            'email',
            'phone',
            'age',
            'address',
            'blood',
            'school',
            'grade',
            'ins',
            'roles',
            'permissions'
        ));

        return redirect()->route('admin.auth.user.index')->withFlashSuccess(__('alerts.backend.users.updated'));
    }


    /**
     * @param Request $request
     * @param User              $user
     *
     * @throws \App\Exceptions\GeneralException
     * @throws \Throwable
     * @return mixed
     */
    public function updateCustomer(Request $request, User $user)
    {
        $this->userRepository->updateCustomer($user, $request->only(
            'first_name',
            'last_name',
            'email',
            'phone',
            'age',
            'address',
            'blood',
            'school',
            'grade',
            'ins',
            'roles',
            'permissions'
        ));

        return redirect()->route('admin.customer.index')->withFlashSuccess(__('alerts.backend.users.updated'));
    }

    /**
     * @param ManageUserRequest $request
     * @param User              $user
     *
     * @throws \Exception
     * @return mixed
     */
    public function destroy(ManageUserRequest $request, User $user)
    {
        $this->userRepository->deleteById($user->id);

        event(new UserDeleted($user));

        return redirect()->route('admin.auth.user.deleted')->withFlashSuccess(__('alerts.backend.users.deleted'));
    }

    public function select2LoadMore(Request $request)
    {
        $search = $request->get('search');
        $data = User::select(['id', 'first_name', 'last_name', 'created_at'])->where(DB::raw("CONCAT(`first_name`, ' ', `last_name`)"), 'LIKE', '%' . $search . '%')->orderBy('created_at', 'desc')->paginate(5);
        return response()->json(['items' => $data->toArray()['data'], 'pagination' => $data->nextPageUrl() ? true : false]);
    }

    public function search(Request $request){
        $searching = $request->input('search');

        //now get all user and services in one go without looping using eager loading
            //In your foreach() loop, if you have 1000 users you will make 1000 queries
          $users = User::Where('email','like','%'.$searching.'%')->orWhere(DB::raw("CONCAT(`first_name`, ' ', `last_name`)"), 'LIKE', '%' . $searching . '%')->orderBy('id')->paginate(6);
            return view('backend.auth.user.index', compact('users'));
    }

    public function searchCustomer(Request $request){
        $searching = $request->input('search');

        //now get all user and services in one go without looping using eager loading
            //In your foreach() loop, if you have 1000 users you will make 1000 queries
          $users = User::Where('email','like','%'.$searching.'%')->orWhere(DB::raw("CONCAT(`first_name`, ' ', `last_name`)"), 'LIKE', '%' . $searching . '%')->orderBy('id')->paginate(6);
            return view('backend.customer.index', compact('users'));
    }


}
