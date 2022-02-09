@extends('layout.master')
@section('title' ,'User')
@section('links')
<style>
  .buttonn-div{
    float: right;
    margin: 10px; 
}
.button-list button{
  padding: 3px;
    font-size: 10px;
}
.contian{
  margin: 5px;
  padding: 10px;
  background: whitesmoke;
}
.requidefield{
  /*margin-top: -10px;*/
    color: crimson;
}
#view_list{
  display: none;
}
.success{
  margin: 10px;
}
.one_div{
position: relative;
}
.two_div{
    position: absolute;
    background: rgba(225,225,225,0.7);
    top: 0px;
    padding: 140px;
    width: 100%;
    z-index: 11;
    text-align: center;
    font-size: 40px;
    color: indianred;
    opacity: 0.5;
    display: none;
    }
/*#two_div{
display: none;
}*/

.extra-css{
  margin-top: 30px;
}
</style>
@endsection

@section('content')
<div class="row">
      <div class="col-md-12">
               <div class="buttonn-div">
                     <button class="btn btn-primary" id="add">Add user</button>
                     <button class="btn btn-primary" id="view">View list</button>
                </div>                  
        </div>
</div>
<div class="row">
<div class="success" id="success"></div>
</div>
<div class="contian csv" id="add_form">
    <form id="user_form">  
       @csrf
    <div class="row">
              <div class="col-md-4">
                    <div class="form-group">
                        <label  class="font-20">Name</label>
                        <input type="text" name="name" id="name" class="form-control form-control-sm" />
                    </div> 
                     <div class="name requidefield"></div>
                </div>
            
              <div class="col-md-4">
                    <div class="form-group">
                        <label  class="font-20">Email</label>
                         <input type="email" name="email" id="email" class="form-control form-control-sm" />
                    </div> 
                     <div class="email requidefield"></div>
                </div>
           
              <div class="col-md-4">
                    <div class="form-group">
                        <label  class="font-20">mobile</label>
                        <input type="text" name="mobile" id="mobile" class="form-control form-control-sm" />
                    </div> 
                     <div class="mobile requidefield"></div>

                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label  class="font-20">Address</label>
                        <input type="text" name="address" id="address" class="form-control form-control-sm" />
                    </div> 
                    <div class="address requidefield"></div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label  class="font-20">Password</label>
                        <input type="password" name="password" id="password" class="form-control form-control-sm" />
                    </div> 
                   <div class="password requidefield"></div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label  class="font-20">Password confirmation</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control form-control-sm" />
                    </div> 
                </div>


            </div>
              <div class="form-group">
               <input type="hidden" name="id" id="id"/>
              </div>
            
            <div class="row">
                <div class="col-md-12 d-flex justify-content-end extra-css">
                    <div class="form-group">
                        <button class="btn btn-primary pull-right" id="action" value="submit">Submit</button>
                    </div>
                </div>
            </div>
      </form>


</div>


<div class="contian csv" id="view_list">
   
    <div class="one_div" id="one_div">
                                    <table class="table table-border-less" id="data_list" style="width: 100%">
                                        <thead>
                                            <tr><th>ID</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>mobile</th>
                                                <th>Address</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            

                                        </tbody>
                                    </table>
               <div class="two_div">
             <!-- <i class="fa fa-spinner fa-pulse fa-lg fa-fw"></i><span class="sr-only">Loading...</span> -->
             </div>       
                                      
             </div>
                       
             
</div>

@endsection


@section('script')
<script>
    $("#add").click(function(){
    $(".csv").css('display' ,'none');
    $("#add_form").css('display' ,'block');
    $('#csv_form')[0].reset();
    $('#action').val('submit');
  $('#action').html('submit');

});
     $("#view").click(function(){
    $(".csv").css('display' ,'none');
    $("#view_list").css('display' ,'block');
});
</script>
<script >
//   //datatable loading.
  $(function() {
 $('#data_list').DataTable({
    processing :true,
    serverSide: true,
    ajax : `{{ route('user.list') }}`,
    columns:[
          { data : 'id', name: 'id' }, 
          { data : 'name', name : 'name' },
          { data : 'email', name :'email' },
          { data : 'mobile', name :'mobile' },
          { data : 'address', name :'address' },
          { data : 'action', name : 'action' }
    ]
  });
});
 //end
</script>
<script>
  $(document).ready(function(){ 
        $('#user_form').on('submit', function(event){
        event.preventDefault();
        if($('#action').val() == 'submit'){
           $('.requidefield').css('display' ,'none');
             $('.form-control').css('border-color' ,'#ced4da');
             $('#action').val('');
             $('#action').html('<i class="fa fa-spinner fa-pulse fa-lg fa-fw"></i><span class="sr-only">Loading...</span>');
          $.ajax({
            url:"{{ route('user.store') }}",
            method:"post",
            data:new FormData(this),
            dataType:"json",
            contentType:false,
            cache:false,
            processData:false,
            success:function(data){
              console.log(data);
          if(data.error){
            if(data.error.length > 0)
            {
               var error_html ="";
              for (let count = 0; count < data.error.length; count++){
                error_html = '<div>'+data.error[count]+'</div>';
                $('#'+data.field_name[count]).css('border-color','red');
                $('.'+data.field_name[count]).html(error_html);
                $('.'+data.field_name[count]).css('display' ,'block');
              }

            }
            
          }

          if(data.success){
                 $('#success').html(data.success);
                 $('#user_form')[0].reset();
                   $('.requidefield').css('display' ,'none');
                   $('.form-control').css('border-color' ,'#ced4da');
                     $('#data_list').DataTable().ajax.reload();
               }

            $('#action').val('submit');
            $('#action').html('submit');


          }
          });
          }


        if($('#action').val() == 'update'){

             $('.requidefield').css('display' ,'none');
             $('.form-control').css('border-color' ,'#ced4da');
             $('#action').val('');
             $('#action').html('<i class="fa fa-spinner fa-pulse fa-lg fa-fw"></i><span class="sr-only">Loading...</span>');
  
             $.ajax({
            url:`{{ route('user.update') }}`,
            method:"post",
            data:new FormData(this),
            dataType:"json",
            contentType:false,
            cache:false,
            processData:false,
            success:function(data){
          if(data.error){
            if(data.error.length > 0)
            {
            var error_html ="";
              for (let count = 0; count < data.error.length; count++){
                error_html = '<div>'+data.error[count]+'</div>';
                $('#'+data.field_name[count]).css('border-color','red');
                $('.'+data.field_name[count]).html(error_html);
                $('.'+data.field_name[count]).css('display' ,'block');
              }

            }
            
          }

          if(data.success){
                 $('#success').html(data.success);
                 $('#user_form')[0].reset();
                   $('.requidefield').css('display' ,'none');
                   $('.form-control').css('border-color' ,'#ced4da');
                     $('#data_list').DataTable().ajax.reload();
               }

            $('#action').val('submit');
            $('#action').html('submit');


          }
          });
         


        }

 });
});
</script>

<script>
//   function deleting(id){
//     $('.two_div').css('display','block');
//  $.ajax({
//           url: "",
//           data:{"id":id, "_token": "{{ csrf_token() }}"},   
//           method: 'get',
//           dataType:"json"
//       }).done(function(response){
//         $('#success').html(response.success);
//          $('#data_list').DataTable().ajax.reload();
//       });
// $('.two_div').css('display','none');
//   }

  

  function deleting(id){
    $('.two_div').css('display','block');
 $.ajax({
          url: `{{ route('user.list.delete') }}`,
          data:{"id":id, "_token": "{{ csrf_token() }}"},   
          method: 'get',
          dataType:"json"
      }).done(function(response){
        $('#success').html(response.success);
         $('#data_list').DataTable().ajax.reload();
      });
     $('.two_div').css('display','none');
  }

  

  function edit(id){
       $('.two_div').css('display','block');
       $('.requidefield').css('display' ,'none');
       $('.form-control').css('border-color' ,'#ced4da');
     $.ajax({
          url: `{{ route('user.list.edit') }}`,
          data:{"id":id, "_token": "{{ csrf_token() }}"},   
          method: 'get',
          dataType:"json"
      }).done(function(response){
            console.log(response);

            $(".csv").css('display' ,'none');
            $("#add_form").css('display' ,'block');
        $('#id').val(response.id);
        $('#name').val(response.name);
        $('#email').val(response.email);
        $('#mobile').val(response.mobile);
        $('#address').val(response.address);
         // $('#name').val(response.name);


            $('#action').val('update');
         $('#action').html('update');
         });
        $('.two_div').css('display','none');
  }

  
</script>

@endsection