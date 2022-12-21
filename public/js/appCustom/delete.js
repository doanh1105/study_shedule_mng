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


function deletePhongHoc(delete_domain){
    Swal.fire({
        title: 'Xoá phòng học này?',
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


function deleteMonHoc(delete_domain){
    Swal.fire({
        title: 'Xoá môn học này?',
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

function deletePhanCong(delete_domain){
    Swal.fire({
        title: 'Xoá phân công này?',
        text:'Không thể hoàn tác hành động này!',
        showDenyButton: true,
        showCancelButton: true,
        showConfirmButton: false,
        cancelButtonText: 'Huỷ',
        denyButtonText: `Xoá`,
    })
    .then((result) => {
        if (result.isDenied) {
            window.location.href = delete_domain;
        }
    })
}

function deleteLichHoc(delete_domain){
    Swal.fire({
        title: 'Xoá lịch học này?',
        text:'Chú ý: Không thể hoàn tác hành động này!',
        showDenyButton: true,
        showCancelButton: true,
        showConfirmButton: false,
        cancelButtonText: 'Huỷ',
        denyButtonText: `Xoá`,
    })
        .then((result) => {
            if (result.isDenied) {
                window.location.href = delete_domain;
            }
        })
}
