<?php

namespace App\MiniSend\Utils;

class Constants
{

	const FILTER_PARAM_IGNORE_LIST = ['page','pageSize','q','search_text','uri'];

    const STATUS_PENDING = "PENDING";
	const STATUS_POSTED = "POSTED";
	const STATUS_SENT = "SENT";
	const STATUS_FAILED = "FAILED";

    const DEFAULT_PAGE_SIZE = 25;
}