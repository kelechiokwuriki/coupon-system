<?php

namespace App\Repositories;

use App\Repositories\Base\BaseRepository;
use App\Rule;

class RuleRepository extends BaseRepository
{
    protected $ruleModel;

    public function __construct(Rule $ruleModel)
    {
        parent::__construct($ruleModel);
    }
}
