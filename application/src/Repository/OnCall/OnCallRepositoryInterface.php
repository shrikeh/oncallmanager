<?php
namespace OnCallManager\Repository\OnCall;

use DateTime;
use OnCallManager\Collection\OnCall as OncallCollection;
use OnCallManager\Customer;

/**
 * Interface OnCallRepositoryInterface
 * @package OnCallManager\Repository\OnCall
 */
interface OnCallRepositoryInterface
{
    public function findByCustomer(
        Customer $customer,
        DateTime $start,
        DateTime $end
    ): OnCallCollection;
}