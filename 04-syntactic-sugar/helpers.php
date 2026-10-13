<?php

// Đừng bắt bộ não phải nhớ tham số true/false nữa
function json_to_array(string $json): array
{
	return json_decode($json, true);
}

// Chuyển một biểu thức toán học khô khan thành một hành động dễ hiểu
function coin_flip(): bool
{
	return rand(1, 100) > 50;
}