var funcBefore = function () {
		$('#send_new_comment').text(function(){
			window.info = 1;
			window.interval = setInterval(function(){
				if(info == 1){
					$('#send_new_comment').html('Отправление.');
				} else if (info == 2) {
					$('#send_new_comment').html('Отправление..');
				} else if (info == 3) {
					$('#send_new_comment').html('Отправление...');
					info = 0;
				}
				info++;
			}, 250);
		});
	},
	funcSuccess = function (data) {
		if (data != 'error') {
			var comCounter = $('#com_counter').html();
			comCounter = +comCounter + 1;
			$('#com_counter').html(comCounter);
			$('#send_new_comment').text('Отправилось');
			$('#send_new_comment').css('background', '#ef7');
			offButton = false;
			$('#comments').append(data);
			clearInterval(interval);
			setTimeout(funcAfter, 2000);
		} else {
			clearInterval(interval);
			$('#send_new_comment').html('Ошибка');
			$('#send_new_comment').css('background', '#faa');
			offButton = false;
			setTimeout(funcAfter, 2000);
		}
	},
	funcAfter = function() {
		$('#send_new_comment').css('background', '#fff');
		$('#send_new_comment').html('Отправить');
	}

var offButton = false;
$(document).ready(function(){
	// delete class of body
	$('body').removeAttr('class');

	$('#getIn').click(getIn);
	$('#obrSvz').click(obrSvz);
	$('#getReg').click(getReg);
	$('.remove').click(removeForm);

	$('#send_new_comment').click(function() {
		if (!offButton) {
			offButton = true;
			var id = 	$('#num_news').val(),
				login = $('#nickname').val(),
				text = 	$('#new_comment_area').val();
				id_s =	$('#user_id').val();
			if (text.match(/\S/)) {
				$.ajax ({
					url: "../php/new_comment.php",
					type: "POST",
					data: ({
						id: id,
						login: login,
						user_id: id_s,
						text: text
					}),
					dataType: "html", // || html
					beforeSend: funcBefore,
					success: funcSuccess
				});
			} else {
				$('#send_new_comment').html('Ошибка');
				$('#send_new_comment').css('background', '#faa');
				offButton = false;
				setTimeout(funcAfter, 2000);
			}
		} else {

		}
	});

	$('#form-reg-button').click(function(){
		removeForm();
		getReg();
	});
	$('#form-getin-button').click(function(){
		removeForm();
		getIn();
	});
	$('#switch-select').click(function(){
		var checkbox =
		"<input class='cb1' type='checkbox' name='navig2' value='1' id='check1'><label for='check1'>Заголовок</label><br>" +
		"<input class='cb1' type='checkbox' name='navig3' value='1' id='check2'><label for='check2'>Описание</label><br>" +
		"<input class='cb1' type='checkbox' name='navig4' value='1' id='check3'><label for='check3'>Текст</label><br>" +
		"<input class='cb1' type='checkbox' name='navig5' value='1' id='check4'><label for='check4'>Теги</label>"
		$('#select-div').html(checkbox);
	});
});

function getIn() {
	$('#blockGetIn').show();
}
function obrSvz() {
	$('#blockObrSvz').show();
}
function getReg() {
	$('#blockReg').show();
}
function removeForm() {
	$('#blockObrSvz').hide();
	$('#blockGetIn').hide();
	$('#blockReg').hide();
}
