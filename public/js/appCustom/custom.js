function validateTime(event, start_time_id, end_time_id){
    let start_time = document.getElementById(start_time_id).value;
    let end_time = document.getElementById(end_time_id).value;
    if(start_time >= end_time){
        event.preventDefault();
        Swal.fire(
            'Thông tin không hợp lệ!',
            'Vui lòng chọn thời gian bắt đầu và kết thúc hợp lệ.',
            'info'
          )
    }
}
