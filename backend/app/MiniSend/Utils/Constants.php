<?php

namespace App\MiniSend\Utils;

class Constants
{

	const FILTER_PARAM_IGNORE_LIST = ['page','pageSize','q','search_text'];

    const STATUS_PENDING = "PENDING";
	const STATUS_ACTIVE = "ACTIVE";
	const STATUS_DISABLE = "DISABLED";
	const STATUS_ACCEPTED = "ACCEPTED";
	const STATUS_REJECTED = "REJECTED";

    const DEFAULT_PAGE_SIZE = 25;
}