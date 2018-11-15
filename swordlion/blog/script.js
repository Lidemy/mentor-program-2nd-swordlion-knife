$(document).ready(() => {
  var spliter = location.href.split('?article=');
  if(spliter[1]) {
    $('.create__article').css('display','none');
    $('.back').css('display','inline-block');
    $('.back').on('click', () => {
      window.location = spliter[0];
    })
  }
  $('.create__article').on('click',() => {
    $('.create__article').css('display','none');
    $('.article-list').css('display','none');
    $('.back').css('display','inline-block');
    $('.create__article__form').css('display','block');
    // 這邊寫emoji的欄位

    for(var i = 0; i < emojiSet[0].emoji.length; i++ ) {
      $('.main').append(`
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
  // 這裡如果有選取文章的話 下面的留言欄的 dropdown 新增 emoji

  if(spliter[1]) {
    for(var i = 0; i < emojiSet[0].emoji.length; i++ ) {
      $('.comment').append(`
          <div class='dropdown-menu__emoji'>` + emojiSet[0].emoji[i] + `</div>
      `);
    }
    $('.dropdown-menu__emoji').on('click',e => {
      var text = $(e.target).parent().parent().next().val();
      text += $(e.target).text();
      $(e.target).parent().parent().next().val(text);
    })
  }
  //這裡是發佈文章的 Ajax
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

        //網路上抓的判斷 javascript 判斷 <br> 方法的function
        function nl2br (str, is_xhtml) {   
          var breakTag = (is_xhtml || typeof is_xhtml === 'undefined') ? '<br />' : '<br>';    
          return (str + '').replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, '$1'+ breakTag +'$2');
        }


        const res = JSON.parse(resp);
        const id = res.userid;
        const time = res.time;
        const nickname = res.nickname;
        const num = res.num;
        var url = location.href;
        var newurl = url + '?article=' + num;
        if(content.length > 100) {
          var newcontent = '';
          for(var i = 0; i < 100; i++ ) {
            newcontent += content[i];
          }
        } else {
          newcontent = content;
        }
        nl2br(newcontent);
        if (res.result === 'success') {
          $('.create__article__form').css('display','none');
          $('.article').css('display','block');
          $('.article-list').prepend(`
            <div class='article'>
              <div class='article__area'>
                <div class='userDetail'>
                  <div><img src='avatar/${id%9+1}.png' class='userDetail__avatar' /></div>
                  <div>
                    <div class='userDetail__creater'>${nickname}</div>
                    <div class='userDetail__created_at'>${time}</div>
                  </div>
                </div>
                <h>${title}</h>
                <p>${nl2br(newcontent)}<a href=${newurl} class='continue'>繼續閱讀...</a></p>
              </div>
            </div>
            `)
        }
      }
    })
  })
  // 副留言 AJAX
  $(document).on('submit','.subcomment__form', e => {
    
    e.preventDefault();
    var major = $(e.target).find('input[name=major]').val();
    var content = $(e.target).find('textarea[name=content]').val();

    $.ajax ({
      type : 'POST',
      url : 'create__subcomment.php',
      data : {
        major : major,
        content : content
      },
      success:(resp) => {

        //網路上抓的判斷 javascript 判斷 <br> 方法的function
        function nl2br (str, is_xhtml) {   
          var breakTag = (is_xhtml || typeof is_xhtml === 'undefined') ? '<br />' : '<br>';    
          return (str + '').replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, '$1'+ breakTag +'$2');
        }

        const res = JSON.parse(resp);
        const id = res.userid;
        const time = res.time;
        const nickname = res.nickname;
        const num = res.num;
        var newcontent = nl2br(content);
        if (res.result === 'success') {
          if(!$('.reminder').next().hasClass('subcomment-list')) {
            $('.leavecomment-area').before(`<div class='subcomment-list'></div>`)
          }
          $('.subcomment-list').prepend(`
            <div class='subcomment'>
              <div class='userDetail'>
                <div>
                  <img src=avatar/${id%9+1}.png class='userDetail__avatar' />
                </div>
                <div>
                  <div class='userDetail__creater'>${nickname}</div>
                  <div class='userDetail__created_at'>${time}</div>
                </div>
              </div>
              <p>${newcontent}</p>
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
  $(".comment__form__button").click(e => {
    if(e.target.innerText == "還沒有帳號嗎QQ") {
      window.location="register.php";
    } else if(e.target.innerText == "我已經有帳號了!") {
      window.location="login.php";
    }
  })
})
ShowTime = () => {
　var Today = new Date();
  $('#showbox').text(Today.getFullYear() + " 年 " + (Today.getMonth()+1) + " 月 " + Today.getDate() + " 日 , 今天開始加油吧😊");
  setTimeout('ShowTime()',3600*24);
}
