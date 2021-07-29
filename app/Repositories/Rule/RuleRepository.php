<?php

namespace App\Repositories\Rule;

use App\Repositories\BaseRepository;
use App\Rule;

class RuleRepository extends BaseRepository
{
    protected $ruleModel;

    public function __construct(Rule $ruleModel)
    {
        parent::__construct($ruleModel);
    }
}
