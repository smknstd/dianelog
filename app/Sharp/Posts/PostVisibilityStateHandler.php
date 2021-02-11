<?php

namespace App\Sharp\Posts;

use App\Models\Post;
use App\Models\Utils\WithVisibility;
use Code16\Sharp\EntityList\Commands\EntityState;

class PostVisibilityStateHandler extends EntityState
{
    protected function buildStates()
    {
        $this->addState(WithVisibility::$online, "En ligne", self::PRIMARY_COLOR)
            ->addState(WithVisibility::$offline, "Masqué", self::GRAY_COLOR);
    }

    protected function updateState($instanceId, $stateId)
    {
        Post::findOrFail($instanceId)->update([
            "visibility" => $stateId
        ]);

        return $this->refresh($instanceId);
    }
}
