$('#id_giangVien').select2({
    allowClear: true,
    theme: 'bootstrap4',
    placeholder: "Chọn giảng viên",
})
$('#id_phongHoc').select2({
    allowClear: true,
    theme: 'bootstrap4',
    placeholder: "Chọn phòng học",
})
$('#id_ngayDay').select2({
    allowClear: true,
    theme: 'bootstrap4',
    placeholder: "Chọn ngày học",
})
$('#id_tietHoc').select2({
    theme: 'bootstrap4',
    placeholder: "Chọn tiết học",
})
$('#id_monHoc').select2({
    allowClear: true,
    theme: 'bootstrap4',
    placeholder: "Chọn môn học",
})


function noDelete(){
    Swal.fire(
        'Thông tin!',
        'Không thể thay đổi phân công môn học này, chỉ có thể xoá và xếp lại.',
        'info'
    )
}

function requireValidate(event){
    if(!$('#id_monHoc').val() || $('#id_tietHoc').val().length < 1 || !$('#id_ngayDay').val() || !$('#id_ngayDay').val() || !$('#id_phongHoc').val() || !$('#id_giangVien').val()){
        event.preventDefault();
        Swal.fire(
            'Thông tin!',
            'Vui lòng chọn đầy đủ các thông tin để xếp phân công!',
            'info'
        )
    }
}
