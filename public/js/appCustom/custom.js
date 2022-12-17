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

function validateDate(event , start_time_id, end_time_id){
    let start_time = document.getElementById(start_time_id).value;
    let end_time = document.getElementById(end_time_id).value;
    if(!start_time){
        event.preventDefault();
        Swal.fire(
            'Vui lòng nhập đầy đủ thông tin!',
            'Vui lòng chọn thời gian bắt đầu',
            'info'
        )
    }
    if(!end_time){
        event.preventDefault();
        Swal.fire(
            'Vui lòng nhập đầy đủ thông tin!',
            'Vui lòng chọn thời gian kết thúc.',
            'info'
        )
    }
    if(start_time && end_time) {
        let startDate = new Date(start_time);
        let endDate = new Date(end_time);
        if(startDate.getTime() >= endDate.getTime()){
            event.preventDefault();
            Swal.fire(
                'Thông tin không hợp lệ!',
                'Vui lòng chọn thời gian bắt đầu và kết thúc hợp lệ.',
                'info'
            )
        }
    }
}
