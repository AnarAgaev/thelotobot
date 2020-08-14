<?
	/*
	 * 1. Редактируем языковой JSON файл, делая ПЕРЕВОД НА НУЖНЫЙ ЯЗЫК
	 * 2. ПРОВЕРЯЕМ ОТРЕДАКТИРОВАННЫЙ JSON с помощью любого сервиса
	 * 3. КЛАДЁМ ОТРЕДАКТИРОВАННЫЙ JSON в корень сайта
	 * 4. В бд В ТАБЛИЦУ LANGUAGES ДОБАВЛЯЕМ НОВЫЙ ЯЗЫК
	 * 5. Кладём ФАЙЛ добавления языка parse-lang.php В КОРЕНЬ САЙТА
	 * 6. В рабочем файле в строке декодирования json МЕНЯЕМ ИМЯ ДЕКОДИРУМОГО ФАЙЛА на новое
	 * 7. МЕНЯЕМ ПЕРЕМЕННУЮ ИДЕНТИФИКАТОР ЯЗЫКА $langid в рабочем файле
	 * 8. Раскомментировать sql запрос на добавление данных в бд
	 * 9. Запускаем файл ОДИН РАЗ!!! После этого в бд должен появиться новый язык
	 * 10. ЗАКОММЕНТИРОВАТЬ, ВО ИЗБЕЖАНИЕ СЛУЧАЙНОГО ДОБАВЛЕНИЯ SQL ЗАПРОС ДОБАВЛЕНИЯ ЯЗЫКА В БД
	 * 11. ДОБАВЛЯЕМ ПРОВЕРКУ И ПЕРЕАДРЕСАЦИЮ RewriteRule на добавляемый язык в файле .htaccess
	 * 12. Добавляем соответствующию ПРОВЕРКУ НА НОВЫЙ ЯЗЫК В ФАЙЛ УСТАНАВЛИВАЮЩИЙ ЯЗЫК В СЕССИЮ utils/set-lang.php
	 * 13. В файле подключения шрифта template/fonts.php елси нужен отдельный шрифт для добавляемого языка ставим проверку и подключение
	 * 14. Тест сайта на корректность отображения в новой языковой версии
	*/

  require_once 'config/connect.php'; // Connection db

	$jsonObject = json_decode(file_get_contents('et.json'), true); // parse json
	$langId = 30;
	$idPage;
	$nameContentBlock;
	$valueContentBlock;

	// Get data from object
	foreach ($jsonObject as $arr) {

		foreach ($arr as $key => $value) {
			switch ($key) {
				case 'id_page':
					$idPage = $value;
					break;
				case 'name_content_block':
					$nameContentBlock = $value;
					break;
				case 'value_content_block':
					$valueContentBlock = $value;
					break;
	    }
		}

		// Adding data to db
//		mysqli_query($link, "
//			INSERT INTO `content`(
//				`id_content_block`,
//				`id_lang`,
//				`id_page`,
//				`name_content_block`,
//				`value_content_block`)
//			VALUES (
//				null,
//				'$langId',
//				'$idPage',
//				'$nameContentBlock',
//				'$valueContentBlock')");

	}

?>