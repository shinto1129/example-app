$(function(){
    let dataBox;
    let userId;
    $("#btn1").click(function () {
        userId = $(this).data('user-id');
        $(this).toggleClass('btn2');
        $.ajaxSetup({
        headers: {
          "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
      });
        $.ajax({
          //POST通信
          type: "post",
          //ここでデータの送信先URLを指定します。
          url: "/chenge",
          dataType: "json",
          data: {
            'user_id': userId,
          },

        })
          //通信が成功したとき
          .then((res) => {
            console.log(res);
          })
          //通信が失敗したとき
          .fail((error) => {
            console.log(error.statusText);
          });
      });
      $(".delete").click(function(){
        if(!confirm("取り消しますか?")){
            return false;
        }else{
            return true;
        }
      })
      $(".delete1").click(function(){
        if(!confirm("本当に削除してもよろしいですか?")){
            return false;
        }else{
            return true;
        }
      })
      $(".edit").click(function(){
        if(!confirm("内容は間違いありませんか?")){
            return false;
        }else{
            return true;
        }
      })

    $('#testModal1').on('show.bs.modal', function (event) {
        //モーダルを開いたボタンを取得
        var button = $(event.relatedTarget);
        //data-periodの値取得
        var periodVal = button.data('period');
        var weekVal = button.data('week');

        //モーダルを取得
        var modal = $(this);
        console.log(periodVal);
        console.log(weekVal);



        var select1 = document.getElementById("period-select");
        var select2 = document.getElementById("week-select");

        select1.options[periodVal-1].selected = true;
        select2.options[weekVal-1].selected = true;



        //受け取った値をspanタグのとこに表示
        modal.find('.modal-header span#morau').text(periodVal+'の');
    });

    $('#testModal3').on('show.bs.modal', function (event) {
        //モーダルを開いたボタンを取得
        var button = $(event.relatedTarget);
        //data-periodの値取得
        var periodVal = button.data('period');
        var weekVal = button.data('week');

        //モーダルを取得
        var modal = $(this);
        console.log(periodVal);
        console.log(weekVal);



        var select1 = document.getElementById("period-select");
        var select2 = document.getElementById("week-select");

        select1.options[periodVal-1].selected = true;
        select2.options[weekVal-1].selected = true;



        //受け取った値をspanタグのとこに表示
        modal.find('.modal-header span#morau').text(periodVal+'の');
    });

    /*
    $('#testModal').on('show.bs.modal', function (event) {
        //モーダルを開いたボタンを取得
        var button = $(event.relatedTarget);
        //data-periodの値取得
        var periodVal = button.data('period');
        var weekVal = button.data('week');
        var roomVal = button.data('room');
        var registerVal = button.data('registerid');
        var userVal = button.data('userid');
        var count = button.data('count');
        const itemBox = [];
        const selectItem = button.data('item2');

        //モーダルを取得
        var modal = $(this);
        console.log(selectItem);
        console.log(count);


        for(let i = 1; i < count; i++){
            itemBox[i] = button.data("item"+i);
            if(itemBox[i] === i ){
                var itemselect = document.getElementById("checkbox"+i);
                itemselect.checked = true;
                console.log(itemBox[i]);
            }
            else{
                var itemselect = document.getElementById("checkbox"+i);
                itemselect.checked = false;
            }
        }

        var select1 = document.getElementById("period-select");
        var select2 = document.getElementById("week-select");
        var select3 = document.getElementById("room-select");
        const options1 = select1.options;
        const options2 = select2.options;
        const options3 = select3.options;



        document.getElementById( "user_value" ).value = userVal;
        document.getElementById( "register_value" ).value = registerVal;
        options1[periodVal-1].selected = true
        options2[weekVal-1].selected = true
        options3[roomVal-1].selected = true


        //受け取った値をspanタグのとこに表示
        modal.find('.modal-header span#morau').text(periodVal+'の');
    });
    */
});
