@extends('master-layout')

@section('title')
    User
@endsection



@section('breadcrumbs')
    <!--begin::Item-->
    <li class="breadcrumb-item text-gray-600 fw-bold lh-1">User</li>
    <!--end::Item-->
    <!--begin::Item-->
    <li class="breadcrumb-item">
        <i class="ki-outline ki-right fs-7 text-gray-700 mx-n1"></i>
    </li>
    <!--end::Item-->
    <!--begin::Item-->
    <li class="breadcrumb-item text-gray-500">Daftar User</li>
    <!--end::Item-->
@endsection

@section('body')
    <div class="row">
        <div class="col-md-3">
            <div class="shadow-sm card card-flush mb-0" data-kt-sticky="true" data-kt-sticky-name="docs-sticky-summary"
                data-kt-sticky-offset="{default: false, xl: '200px'}" data-kt-sticky-width="{lg: '250px', xl: '300px'}"
                data-kt-sticky-left="auto" data-kt-sticky-top="100px" data-kt-sticky-animation="false"
                data-kt-sticky-zindex="95">
                <div class="card-header bg-success">
                    <h4 class="card-title">Tambah User</h4>
                </div>
                <div class="card-body">
                    <form id="form-add-user">
                        @csrf
                        <div class="form-group mb-4">
                            <label class="form-label">Username</label>
                            <input type="text" name="username" id="username" placeholder="Username"
                                class="form-control form-control-solid">
                        </div>
                        <div class="form-group mb-4">
                            <label class="form-label">Nama</label>
                            <input type="text" name="name" id="name" placeholder="Nama"
                                class="form-control form-control-solid">
                        </div>
                        <div class="form-group mb-4">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" id="email" placeholder="Email"
                                class="form-control form-control-solid">
                        </div>
                        <div class="form-group mb-4">
                            <label class="form-label">Role</label>
                            <select name="role" id="role" class="form-select form-select-solid"
                                data-control="select2" data-placeholder="Pilih Role User">
                                <option></option>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->id }}">{{ $role->keterangan }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mb-4">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" id="password" placeholder="Password"
                                class="form-control form-control-solid">
                        </div>
                        <div class="form-group mb-4">
                            <label class="form-label">Ketik Ulang Password</label>
                            <input type="password" name="password_confirm" id="password_confirm" placeholder="Password"
                                class="form-control form-control-solid">
                        </div>
                        <div class="form-group mt-4 text-end">
                            <button type="submit" class="btn btn-success">Tambah User</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="card shadow-sm card-flush">
                <div class="card-header border-0 py-5">
                    <div class="col-12">
                        <h3 class="card-title align-items-start flex-column">
                            <span class="card-label fw-bold fs-3 mb-1">Daftar User Aplikasi SIM Budidaya</span>
                        </h3>
                    </div>
                    <div class="col-12">
                        <div class="col-12">
                            <div class="d-flex align-items-center position-relative my-1">
                                <!--begin::Search-->
                                <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                                <span class="svg-icon svg-icon-1 position-absolute ms-6">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2"
                                            rx="1" transform="rotate(45 17.0365 15.1223)" fill="currentColor" />
                                        <path
                                            d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z"
                                            fill="currentColor" />
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                                <input type="text" data-table-filter="search"
                                    class="form-control form-control-solid w-250px ps-14 border border-gray-300"
                                    placeholder="Search " />
                                <!--end::Search-->

                                <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
                                    <!--begin::Export dropdown-->
                                    <button type="button" class="btn btn-light-primary" data-kt-menu-trigger="click"
                                        data-kt-menu-placement="bottom-end">
                                        <span class="svg-icon svg-icon-2">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <rect opacity="0.3" width="12" height="2" rx="1"
                                                    transform="matrix(0 -1 -1 0 12.75 19.75)" fill="currentColor"></rect>
                                                <path
                                                    d="M12.0573 17.8813L13.5203 16.1256C13.9121 15.6554 14.6232 15.6232 15.056 16.056C15.4457 16.4457 15.4641 17.0716 15.0979 17.4836L12.4974 20.4092C12.0996 20.8567 11.4004 20.8567 11.0026 20.4092L8.40206 17.4836C8.0359 17.0716 8.0543 16.4457 8.44401 16.056C8.87683 15.6232 9.58785 15.6554 9.9797 16.1256L11.4427 17.8813C11.6026 18.0732 11.8974 18.0732 12.0573 17.8813Z"
                                                    fill="currentColor"></path>
                                                <path opacity="0.3"
                                                    d="M18.75 15.75H17.75C17.1977 15.75 16.75 15.3023 16.75 14.75C16.75 14.1977 17.1977 13.75 17.75 13.75C18.3023 13.75 18.75 13.3023 18.75 12.75V5.75C18.75 5.19771 18.3023 4.75 17.75 4.75L5.75 4.75C5.19772 4.75 4.75 5.19771 4.75 5.75V12.75C4.75 13.3023 5.19771 13.75 5.75 13.75C6.30229 13.75 6.75 14.1977 6.75 14.75C6.75 15.3023 6.30229 15.75 5.75 15.75H4.75C3.64543 15.75 2.75 14.8546 2.75 13.75V4.75C2.75 3.64543 3.64543 2.75 4.75 2.75L18.75 2.75C19.8546 2.75 20.75 3.64543 20.75 4.75V13.75C20.75 14.8546 19.8546 15.75 18.75 15.75Z"
                                                    fill="currentColor"></path>
                                            </svg>
                                        </span>
                                        Export Data
                                    </button>
                                    <!--begin::Menu-->
                                    <div id="datatable-export"
                                        class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-200px py-4"
                                        data-kt-menu="true">
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="#" class="menu-link px-3" data-kt-export="copy">
                                                Copy to clipboard
                                            </a>
                                        </div>
                                        <!--end::Menu item-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="#" class="menu-link px-3" data-kt-export="excel">
                                                Export as Excel
                                            </a>
                                        </div>
                                        <!--end::Menu item-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="#" class="menu-link px-3" data-kt-export="csv">
                                                Export as CSV
                                            </a>
                                        </div>
                                        <!--end::Menu item-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="#" class="menu-link px-3" data-kt-export="pdf">
                                                Export as PDF
                                            </a>
                                        </div>
                                        <!--end::Menu item-->
                                    </div>
                                    <!--end::Menu-->
                                    <!--end::Export dropdown-->
                                    <div id="datatable-export-btn" class="d-none"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body py-0">

                    <table id="table-user" class="table table-responsive border table-rounded table-row-bordered gx-5">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Username</th>
                                <th class="text-center">Nama</th>
                                <th class="text-center">Email</th>
                                <th class="text-center">Role</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $u)
                                <tr class="align-middle">
                                    <td class="text-center">{{ $loop->index + 1 }}</td>
                                    <td>{{ $u->username }}</td>
                                    <td>{{ $u->nama }}</td>
                                    <td>{{ $u->email }}</td>
                                    <td class="text-center">{{ $u->rolename }}</td>
                                    <td class="text-center">
                                        <button onclick="deleteUser(this)" data-username="{{ $u->username }}" class="btn btn-sm btn-icon btn-danger"><i class="fa fa-ban"></i></button>
                                        <button onclick="resetPassword(this)" data-username="{{ $u->username }}" class="btn btn-sm btn-icon btn-warning"><i class="fa fa-rotate"></i></button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        const urlAddUser = "{{route('users.add')}}"
        const urlDeleteUser = "{{route('users.delete')}}"
        const urlResetPassword = "{{route('users.reset')}}"
    </script>
    <script src="{{url('modules/users/js/index.js')}}"></script>
@endsection
