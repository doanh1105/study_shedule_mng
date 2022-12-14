function deleteKhoa(delete_domain){
    Swal.fire({
        title: 'Xoá Khoá học này sẽ xoá toàn bộ dữ liệu liên quan, bạn có chắc chắn muốn xoá không?',
        showDenyButton: true,
        showCancelButton: true,
        showConfirmButton: false,
        cancelButtonText: 'Huỷ',
        denyButtonText: `Xoá`,
    }).then((result) => {
        if (result.isDenied) {
            window.location.href = delete_domain;
        }
    })
}


function deleteGiangVien(delete_domain){
    Swal.fire({
        title: 'Xoá giảng viên này?',
        showDenyButton: true,
        showCancelButton: true,
        showConfirmButton: false,
        cancelButtonText: 'Huỷ',
        denyButtonText: `Xoá`,
    }).then((result) => {
        if (result.isDenied) {
            window.location.href = delete_domain;
        }
    })
}

function deleteSinhVien(delete_domain){
    Swal.fire({
        title: 'Xoá sinh viên này?',
        showDenyButton: true,
        showCancelButton: true,
        showConfirmButton: false,
        cancelButtonText: 'Huỷ',
        denyButtonText: `Xoá`,
    }).then((result) => {
        if (result.isDenied) {
            window.location.href = delete_domain;
        }
    })
}
