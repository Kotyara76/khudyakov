# Задача
Есть некая база клиентов с полями: 
- ФИО
- должность
- компания (у компании свои поля: название, телефон, адрес)
- мобильный телефон

Что нужно сделать: 
0. Организовать хранение указанной информации;
1. Вывести список клиентов с пагинацией, содержащий колонки ФИО, должность и компания;
2. Клик по ФИО в элементе списка должен вести на детальную страницу клиента, где будут выведены все поля;
3. Клик по названию компании в элементе списка должен открывать попап с возможностью редактирования всех полей компании;
4. Должна быть возможность сортировки элементов списка по каждой колонке в алфавитном порядке.

Решение подготовить для редакции 1С-Битрикс: Стандарт, файлы решения разместить в репозитории git (исключив ядро).

# Установка

Разместить компоненты в директории /local/components/khudyakov или /bitrix/components/khudyakov

Данные хранятся в HL-блоках.

Для тестирования необходимо создать два блока с произвольными параметрами:

1. Блок с данными клиентов. Названия и коды полей не имеют значения. Одно из полей должно быть с типом "Привязка к HL-блоку", оно будет использоваться для показа компании клиента. В качестве связанного блока необходимо выбрать блок м данными компаний.
2. Блок с данными компаний. Названия и коды полей не существенны. 

Разместить на странице компонент со следующим кодом:

<?$APPLICATION->IncludeComponent(
	"khudyakov:clients", 
	".default", 
	array(
		"COMPONENT_TEMPLATE" => ".default",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_ADDITIONAL" => "undefined",
		"COMPANY_BLOCK_ID" => "2",
		"CLIENT_BLOCK_ID" => "1",
		"LIST_DISPLAY_FIELDS" => array(
			0 => "UF_FIO",
			1 => "UF_POSITION",
			2 => "UF_MOBILE_PHONE",
			3 => "UF_COMPANY",
		),
		"LIST_DETAIL_LINK_FIELD" => "UF_FIO",
		"VARIABLE_ALIASES" => array(
			"CLIENT_ID" => "CLIENT_ID",
			"COMPANY_ID" => "COMPANY_ID",
		)
	),
	false
);?>

или через стандартное редактирование страницы в виз. редаторе - компонент khudyakov|Клиенты|Клиенты

# Настройки компонента

Идентификатор таблицы данных клиентов|компании - ID блока с данными компании/клиента

Поля таблицы списка клиентов - коды полей, которые будут показаны в списке клиентов. Порядок в настройках определяет порядок вывода в таблице.

Поле со ссылкой на детальную информацию - код поля, которое будет ссылкой на детальную страницу.

# Функции

Если в таблице присутствует поле с типом "Привязка к HL блоку", при клике по его значение открывается popup с возможностью редактирования данных компании.

При клике на заголовке таблицы происходит сортировка по данным столбца.

