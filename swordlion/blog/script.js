$(document).ready(() => {
  $('.create__article').on('click',() => {
    $('.create__article').css('display','none');
    $('.article-list').css('display','none');
    $('.back').css('display','inline-block');
    $('.create__article__form').css('display','block');
    // 這邊寫emoji的欄位

    for(var i = 0; i < emojiSet[0].emoji.length; i++ ) {
      $('.dropdown-menu').append(`
          <div class='dropdown-menu__emoji'>` + emojiSet[0].emoji[i] + `</div>
        `);
    }
    
    $('.dropdown-menu__emoji').on('click',e => {
      var text = $(e.target).parent().parent().next().val();
      text += $(e.target).text();
      $(e.target).parent().parent().next().val(text);
    })

    $('.back').on('click', () => {
      $('.article-list').css('display','block');
      $('.back').css('display','none');
      $('.create__article__form').css('display','none');
      $('.create__article').css('display','inline-block');
    })

  })

  $(document).on('submit','.create__article__form', e => {
    
    e.preventDefault();
    var title = $(e.target).find('input[name=title]').val();
    var content = $(e.target).find('textarea[name=content]').val();

    $.ajax ({
      type : 'POST',
      url : 'create__article.php',
      data : {
        title : title,
        content : content
      },
      success:(resp) => {

        $('.create__article__form').css('display','none');
        $('.article-list').css('display','block');
        $('.back').css('display','none');
        $('.create__article').css('display','inline-block');


        const res = JSON.parse(resp);
        const id = res.userid;
        const time = res.time;
        const nickname = res.nickname;
        const num = res.num;
        var url = location.href;
        var newurl = url + '?article=' + num;
        if(content.length > 150) {
          var newcontent = '';
          for(var i = 0; i < 150; i++ ) {
            newcontent += content[i];
          }
        } else {
          newcontent = content;
        }
        if (res.result === 'success') {
          $('.create__article__form').css('display','none');
          $('.article').css('display','block');
          $('.article-list').prepend(`
            <div class='article'>
              <div class='article__area'>
                <div class='userdetail'>
                  <div><img src='avatar/${id % 9}.png' class='userdetail__avatar' /></div>
                  <div class='userdetail__createrinfo'>
                    <div class='userdetail__creater'>${nickname}</div>
                    <div class='userdetail__created_at'>${time}</div>
                  </div>
                </div>
                <h>${title}</h>
                <p>${newcontent}<a href=${newurl} class='continue'>繼續閱讀...</a></p>
              </div>
            </div>
            `)
        }
      }
    })
  })

  $(".logout").click( e => {
    document.cookie="member_id=;";
    document.cookie="member_nickname=;";
    window.location.reload();
  })
  $(".buttoncenter").click(e => {
    if(e.target.innerText == "還沒有帳號嗎QQ") {
      window.location="register.php";
    } else if(e.target.innerText == "我已經有帳號了!") {
      window.location="login.php";
    }
  })
  ShowTime = () => {
  　 var Today = new Date();
    document.getElementById('showbox').innerHTML = Today.getFullYear() + " 年 " + (Today.getMonth()+1) + " 月 " + Today.getDate() + " 日 , 今天開始加油吧😊";
    setTimeout('ShowTime()',3600*24);
  }
})
