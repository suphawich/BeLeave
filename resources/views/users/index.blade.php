@extends('layout.go')

@push('style')
    <link href="{{ asset('css/users.css') }}" rel="stylesheet">
@endpush

@push('script')
    <script src="https://cdn.jsdelivr.net/npm/vue-clickaway@2.2.2/dist/vue-clickaway.min.js"></script>
@endpush

@section('title')
    Users
@endsection

@section('script-data')
    isCopyUrl: false,
    isShowNewUser: false,
@endsection

@section('script-methods')
    clickNewUser: function () {
        this.isShowNewUser = true;
    },
    closeNewUser: function () {
        this.isShowNewUser = false;
    },
    copyToClipboard: function (event) {
        event.target.select();
        document.execCommand('copy');
        this.isCopyUrl = true;
        {{-- @focus="$event.target.select()" --}}
    },
    clickAwayUrl: function () {
        this.isCopyUrl = false;
    }
@endsection

@section('content')
    <div class="container-fluid body-content">
        <div class="row">
            <div class="col-md-6 col-sm-8 col-12 pl-0 pr-0" >
                <div class="card">
                  @if(Auth::user()->access_level ==  'Supervisor'||Auth::user()->access_level ==  'Manager' )
                    <div class="card-header">
                        <span>Generate register link</span>
                        <a href="/users/{{ Auth::user()->id }}/retoken" class="float-right"><i class="fa fa-refresh"></i></a>
                    </div>

                    <div class="card-body text-center">
                        <form method="post">

                        <div class="form-group input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">url</span>
                            </div>
                            <input type="text" class="form-control" name="url" value="{{'localhost:8000/register/'.Auth::user()->token}}" v-on:click="copyToClipboard">
                        </div>
                        <label class="copy-message" v-if="isCopyUrl">Copied text to clipboard</label>
                        <label class="copy-message" v-else><i class="fa fa-external-link"></i> Click to copy</label>
                        </form>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 pl-0 pr-0 mt-2">
                @if ($isFull)
                    <button type="button" name="newUser" class="btn btn-light float-right mb-2" v-on:click="clickNewUser" disabled><i class="fa fa-plus"></i> Add New User</button>
                @else
                    <button type="button" name="newUser" class="btn btn-light float-right mb-2" v-on:click="clickNewUser"><i class="fa fa-plus"></i> Add New User</button>
                @endif
                <form action="/users" method="post">
                @csrf
                @method('PUT')
                <div class="form-group input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-search"></i></span>
                    </div>
                    <input type="text" class="form-control" name="search" placeholder="Search by Full Name, E-mail, Phone Number or Task">
                    <input type="submit" name="save" value="" style="display: none;">
                </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-12 table-responsive">
                <form action="users" method="post" >
                @csrf
                <input type="hidden" name="supervisor_id" value="{{ Auth::user()->id }}">
                <input type="hidden" name="company_name" value="{{ Auth::user()->company_name }}">
                <table class="table table-hover">
                    <thead class="table-text">
                        <tr>
                            <th scope="col">Full name</th>
                            <th scope="col" v-if="!isShowNewUser">Supervisor name</th>
                            <th scope="col">Task</th>
                            <th scope="col">E-m ail</th>
                            <th scope="col">Phone number</th>
                        </tr>
                    </thead>
                    <tbody class="tbody-text">
                        <tr v-if="isShowNewUser">
                            <td><input type="text" name="full_name" class="form-control" pattern="[A-Za-z][A-Za-z ]+" placeholder="Full name*" required></td>
                            <input type="hidden" name="access_level" class="form-control" value="Subordinate">
                            <td><input type="text" name="task" class="form-control" pattern="[A-Za-z][A-Za-z ]+" placeholder="Task*" required></td>
                            <td><input type="email" name="email" class="form-control" placeholder="Email address" required></td>
                            <td><input type="text" name="tel" class="form-control" pattern="[0-9][0-9+]+" placeholder="Phone Number" required></td>
                            <td>
                                <button type="cancel" name="save" class="btn btn-success mr-1" v-on:click="closeNewUser"><i class="fa fa-times"></i> Cancel</button>
                                <button type="submit" name="save" class="btn btn-secondary"><i class="fa fa-check-square-o"></i> Ok</button>
                            </td>
                        </tr>
                        @foreach ($subordinates as $subordinate)
                            <tr>
                                <td>{{ $subordinate->full_name }}</td>
                                <td v-if="!isShowNewUser">{{ $subordinate->supervisor_name ?? '-' }}</td>
                                <td>{{ $subordinate->task ?? '-' }}</td>
                                <td>{{ $subordinate->email }}</td>
                                <td>{{ $subordinate->tel }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-2 ml-auto mr-auto mt-5">
                {{ $subordinates->appends(['sort' => request()->sort])->links() }}
            </div>
        </div>
        @if(Auth::user()->access_level == 'Manager' || Auth::user()->access_level == 'Supervisor' )
          <a href="/getPDFUsers"><button style="float: right;" type="button" class="btn btn-outline-dark">Create PDF</button></a>
        @endif
    </div>
@endsection
