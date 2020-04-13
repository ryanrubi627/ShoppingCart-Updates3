@extends('layouts.app_shoppingCart')

@section('super_admin')
<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <!-- Left Side Of Navbar -->
        <ul class="navbar-nav mr-auto">

        </ul>

        <!-- Right Side Of Navbar -->
        <ul class="navbar-nav ml-auto">
            <!-- Authentication Links -->
            @guest
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
                @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                @endif
            @else
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }} <span class="caret"></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    	<a class="dropdown-item" onclick="window.location='{{ url("/admin_page") }}'">Admin page</a>
                    	<a class="dropdown-item" onclick="window.location='{{ url("/user_page") }}'">User page</a>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
            @endguest
        </ul>
    </div>
</nav>
<br>

<div class="container-fluid">
	<div class="row">
		<div class="col-md-1">
		</div>
		<div class="col-md-10">
			<div class="card">
				<h5 class="card-header">
					<a href="#" class="btn btn-success" id="create_user">Create new User</a>
				</h5>
				<div class="card-body">
					<table class="table table-bordered table-hover" style="table-layout: fixed;" id="myTable">
						<thead>
							<tr>
								<th hidden>ID</th>
								<th>Name</th>
								<th>Email (username)</th>
								<th>Roles</th>
								<th>Permission</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							@foreach($users as $user)
							<tr>
								<td hidden>{{ $user->id }}</td>
								<td>{{ $user->name }}</td>
								<td>{{ $user->email }}</td>
								@foreach($user->roles as $role)
									<td>{{ $role->name }}</td>
								@endforeach
								<td>
								@foreach($user->permissions as $permission)
									{{ $permission->name }}<br>
								@endforeach
								</td>
								<td>
									<a href="#" class="btn btn-primary edit_btn">Edit</a>
									<a href="#" class="btn btn-primary delete_btn" id="{{ $user->id }}">Delete</a>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<div class="col-md-1">
		</div>
	</div>
</div>


<!--------------------------REGISTER MODAL-------------------------->
  <div class="modal fade" id="create_user_modal" role="dialog">
    <div class="modal-dialog">
      <!--Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h5>
          	Create new User
          </h5>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-12">
						<form>
							{{ csrf_field() }}
							<div class="form-group">
								<label>Name:</label>
								<input type="text" class="form-control" name="name" id="name"/>
							</div>
							<div class="form-group">
								<label>Email:</label>
								<input type="text" class="form-control" name="email" id="email"/>
							</div>
							<div class="form-group">
								<label>Password:</label>
								<input type="password" class="form-control" name="password" id="password"/>
							</div>
							<div class="form-group">
								<label>Confirm Password:</label>
								<input type="password" class="form-control" name="confrm_pass" id="confrm_pass"/>
							</div>
							<div class="form-group">
								<label>Roles:</label>
								<select class="form-control" name="roles" id="roles">
									<option>user</option>
									<option>admin</option>
									<option>super admin</option>
								</select>
							</div>
							<div class="form-group" id="admin">
								<label>Permission:</label><br>
							    <label class="checkbox-inline">
							    	<input type="checkbox" name="checkbox[]" value="can add item">can add item
							    </label>&nbsp&nbsp&nbsp
							    <label class="checkbox-inline">
							    	<input type="checkbox" name="checkbox[]" value="can edit item">can edit item
							    </label>&nbsp&nbsp&nbsp
							    <label class="checkbox-inline">
							    	<input type="checkbox" name="checkbox[]" value="can delete item">can delete item
							    </label>
							</div>

							<div class="form-group" id="user">
								<label>Permission:</label><br>
							    <label class="checkbox-inline">
							    	<input type="checkbox" value="can add to cart">can add to cart
							    </label>&nbsp&nbsp&nbsp
							    <label class="checkbox-inline">
							    	<input type="checkbox" value="can checkout item">can checkout item
							    </label>
							</div>

							<div class="form-group" id="super_admin">
								<label>Permission:</label><br>
								<label class="checkbox-inline">
							    	<input type="checkbox" class="chkbx_super_admin" name="checkbox[]" value="can add item">can add item
							    </label>&nbsp&nbsp&nbsp
							    <label class="checkbox-inline">
							    	<input type="checkbox" class="chkbx_super_admin" name="checkbox[]" value="can edit item">can edit item
							    </label>&nbsp&nbsp&nbsp
							    <label class="checkbox-inline">
							    	<input type="checkbox" class="chkbx_super_admin" name="checkbox[]" value="can delete item">can delete item
							    </label>
							    <label class="checkbox-inline">
							    	<input type="checkbox" class="chkbx_super_admin" value="can add to cart">can add to cart
							    </label>&nbsp&nbsp&nbsp
							    <label class="checkbox-inline">
							    	<input type="checkbox" class="chkbx_super_admin" value="can checkout item">can checkout item
							    </label>
							</div>
							<hr>
							<button type="submit" id="register_user" class="btn btn-primary" style="float:right">Register</button><br><br>
						</form>
					</div>
				</div>
			</div>
        </div>
      </div>  
    </div>
  </div>
  <!----------------------------EDIT MODAL---------------------------->
  <div class="modal fade" id="edit_user_modal" role="dialog">
    <div class="modal-dialog">
      <!--Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h5>
          	Create new User
          </h5>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-12">
						<form>
							{{ csrf_field() }}
							<div class="form-group" hidden>
								<label>ID:</label>
								<input type="text" class="form-control" name="id" id="id"/>
							</div>
							<div class="form-group">
								<label>Name:</label>
								<input type="text" class="form-control" name="edt_name" id="edt_name"/>
							</div>
							<div class="form-group">
								<label>Email:</label>
								<input type="text" class="form-control" name="edt_email" id="edt_email"/>
							</div>
							<div class="form-group">
								<label>Roles:</label>
								<select class="form-control" name="edt_roles" id="edt_roles">
									<option>user</option>
									<option>admin</option>
									<option>super admin</option>
								</select>
							</div>


							<div class="form-group" id="edt_admin">
								<label>Permission:</label><br>
							    <label class="checkbox-inline">
							    	<input type="checkbox" name="checkbox[]" value="can add item">can add item
							    </label>&nbsp&nbsp&nbsp
							    <label class="checkbox-inline">
							    	<input type="checkbox" name="checkbox[]" value="can edit item">can edit item
							    </label>&nbsp&nbsp&nbsp
							    <label class="checkbox-inline">
							    	<input type="checkbox" name="checkbox[]" value="can delete item">can delete item
							    </label>
							</div>

							<div class="form-group" id="edt_user">
								<label>Permission:</label><br>
							    <label class="checkbox-inline">
							    	<input type="checkbox" value="can add to cart">can add to cart
							    </label>&nbsp&nbsp&nbsp
							    <label class="checkbox-inline">
							    	<input type="checkbox" value="can checkout item">can checkout item
							    </label>
							</div>

							<div class="form-group" id="edt_super_admin">
								<label>Permission:</label><br>
								<label class="checkbox-inline">
							    	<input type="checkbox" class="edt_chkbx_super_admin" name="checkbox[]" value="can add item">can add item
							    </label>&nbsp&nbsp&nbsp
							    <label class="checkbox-inline">
							    	<input type="checkbox" class="edt_chkbx_super_admin" name="checkbox[]" value="can edit item">can edit item
							    </label>&nbsp&nbsp&nbsp
							    <label class="checkbox-inline">
							    	<input type="checkbox" class="edt_chkbx_super_admin" name="checkbox[]" value="can delete item">can delete item
							    </label>
							    <label class="checkbox-inline">
							    	<input type="checkbox" class="edt_chkbx_super_admin" value="can add to cart">can add to cart
							    </label>&nbsp&nbsp&nbsp
							    <label class="checkbox-inline">
							    	<input type="checkbox" class="edt_chkbx_super_admin" value="can checkout item">can checkout item
							    </label>
							</div>
							<hr>
							<button type="submit" id="update_user" class="btn btn-primary" style="float:right">Update</button><br><br>
						</form>
					</div>
				</div>
			</div>
        </div>
      </div>  
    </div>
  </div>




<script>
$(document).ready(function(){

	//OPEN REGISTER MODAL
	$('#create_user').on('click', function(){
		$('#create_user_modal').modal('show'); 
	});

	//REGISTER USER..
	$('#register_user').on('click', function(e){
		e.preventDefault();

		let name = $('#name').val();
		let email = $('#email').val();
		let password = $('#password').val();
		let confrm_pass = $('#confrm_pass').val();
		let roles = $('#roles').val();

		//GET THE CHECKED OF THE CHECKEDBOX
		let permission = [];
        $(':checkbox:checked').each(function(i){
          permission[i] = $(this).val();
        });

        if(password != confrm_pass){
        	alert('The password confirmation does not match.');
        	return false;
        }
        else {
	        $.ajax({
	           type:'POST',
	           url:'/superAdmin_page/register_user',
	           data:{
	           		name,
	           		email,
	           		password,
	           		confrm_pass,
	           		roles,
	           		permission
	           },
	           success:function(){
	           		alert("Register User Successfuly");
	           		$('#create_user_modal').modal('hide');
	           		location.reload(true);
	           }
	        });
    	}
	});

	//SHOW & HIDE PERMISSION FOR REGISTER..
	$('#user').hide();
	$('#admin').hide();
	$('#super_admin').hide();
	$('#roles').on('click', function(){
		if($('#roles').val() == 'user'){
			$('#user').show();
			$('#admin').hide();
			$('#super_admin').hide();
			$('.chkbx_super_admin').prop('checked', false);
		}else if($('#roles').val() == 'super admin'){
			//$('#super_admin').show();
			$('#user').hide();
			$('#admin').hide();
			$('.chkbx_super_admin').prop('checked', true);
		}else {
			$('#user').hide();
			$('#super_admin').hide();
			$('#admin').show();
			$('.chkbx_super_admin').prop('checked', false);
		}
	});


	//RETRIEVE DATA FROM TABLE TO MODAL..
	$('.edit_btn').on('click', function(){
		$('#edit_user_modal').modal('show'); 

		let tr = $(this).closest('tr');

		let data = tr.children("td").map(function(){
			return $(this).text();
		}).get();

		$('#id').val(data[0]);
		$('#edt_name').val(data[1]);
		$('#edt_email').val(data[2]);
		$('#edt_roles').val(data[3]);
	});

	//UPDATE USER..
	$('#update_user').on('click', function(e){
		e.preventDefault();

		let id = $('#id').val();
		let name = $('#edt_name').val();
		let email = $('#edt_email').val();
		let roles = $('#edt_roles').val();

		let edt_permission = [];
        $(':checkbox:checked').each(function(i){
          edt_permission[i] = $(this).val();
        });

        $.ajax({
           type:'POST',
           url:'/superAdmin_page/update_user',
           data:{
           		id,
           		name,
           		email,
           		roles,
           		edt_permission
           },
           success:function(){
           		alert("Update User Successfuly");
           		$('#edit_user_modal').modal('hide');
           		location.reload(true);
           }
        });
	});

	//SHOW & HIDE PERMISSION FOR EDIT..
	$('#edt_user').hide();
	$('#edt_admin').hide();
	$('#edt_super_admin').hide();
	$('#edt_roles').on('click', function(){
		if($('#edt_roles').val() == 'user'){
			$('#edt_user').show();
			$('#edt_admin').hide();
			$('#edt_super_admin').hide();
			$('.edt_chkbx_super_admin').prop('checked', false);
		}else if($('#edt_roles').val() == 'super admin'){
			//$('#edt_super_admin').show();
			$('#edt_user').hide();
			$('#edt_admin').hide();
			$('.edt_chkbx_super_admin').prop('checked', true);
		}else {
			$('#edt_user').hide();
			$('#edt_admin').show();
			$('#edt_super_admin').hide();
			$('.edt_chkbx_super_admin').prop('checked', false);
		}
	});

	//DELETE USER..
	$(".delete_btn").click(function(){
		let id = this.id;

	    if(confirm("Are you sure you want to delete this?")){
	        alert('User Successfuly Deleted');

	        $.ajax({
	           type:'POST',
	           url:'/superAdmin_page/delete_user',
	           data:{id},
	           success:function(){
           		location.reload(true);
           	  }
        	});

	    }
	    else{
	        return false;
	    }
	});

	//DATA TABLE..
	$('#myTable').DataTable()
});
</script>
@endsection