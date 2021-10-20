<?php

/**
 * Преобразует формат даты с базы данных
 *
 * входные данные: 2002-10-20
 * резуальтат: 20.10.2002
 *
 * @param string $date_string
 * @return string
 */
function format_date($date_string) {
	return implode('.', array_reverse(explode('-', $date_string)));
}
