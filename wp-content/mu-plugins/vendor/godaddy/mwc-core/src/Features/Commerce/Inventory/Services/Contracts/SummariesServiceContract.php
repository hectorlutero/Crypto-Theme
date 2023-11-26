<?php

namespace GoDaddy\WordPress\MWC\Core\Features\Commerce\Inventory\Services\Contracts;

use GoDaddy\WordPress\MWC\Core\Features\Commerce\Inventory\Services\Operations\Contracts\ListSummariesOperationContract;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Inventory\Services\Responses\Contracts\ListSummariesResponseContract;

interface SummariesServiceContract
{
    /**
     * List inventory summaries.
     *
     * @param ListSummariesOperationContract $operation
     *
     * @return ListSummariesResponseContract
     */
    public function list(ListSummariesOperationContract $operation) : ListSummariesResponseContract;
}
