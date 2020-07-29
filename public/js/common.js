
$('.submit').on('click', () => confirm('提出しますか？'))

$('.discard_btn').on('click', () => confirm('破棄しますか？'))

$('.self_retrieve').on('click', () => confirm('引戻しますか？'))

$('.retrieve').on('click', () => confirm('差し戻しますか？'))

$('.approve').on('click', () => confirm('承認しますか？'))



$('#logout').on('click', function(e){
    let stay = confirm('ログアウトしますか？');
    if(stay === false) {
        e.preventDefault();
    } else {
        e.preventDefault();
        $('#logout-form').submit();
    }
})

for(let j = 1;j<6;j++) {
    if($('#auth_' + j).val() === '---') {
      for(let i = (j+1);i<6;i++) {
          $('#auth_' + i).prop('disabled', true);
      }
    }
}

for(let j = 1;j<6;j++) {
    $('#auth_' + j).change(function() {
        if($('#auth_' + j).val() !== '---') {
            $('#auth_'+ (j+1)).prop('disabled', false);
        } else {
            for(let i = (j+1);i<6;i++) {
                $('#auth_'+ i).prop('disabled', true).val('---');
            }
        }
    });
}
