<?php

namespace Core\Skills;

interface SkillInterface
{
    public function __construct(&$filters);
    public function applySkill();
}