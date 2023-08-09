function changeStatus(Id) {

  swal({
     title: 'Are you sure?',
     text: "You won't be able to revert this!",
     icon: 'warning',
     showCancelButton: true,
     confirmButtonColor: '#3085d6',
     cancelButtonColor: '#d33',
     confirmButtonText: 'Yes!'
  }).then((result) => {
     if (result.value) {
        $.ajax({
       url: `${APP_URL}/gateway/status/update`,
           method: 'get',
           data: {
             id: Id,
           },
          success: function (data) {
         if (data.success) {
             swal(
               'Good job!',
               data.message,
               'success'
            )
         } else {
             swal(
               'Error!',
               data.message,
               'error'
            )
         }
         location.reload(true);
      },
   });
     }
  })
};