<?php

namespace App\Sharp\Posts;

use App\Models\Post;
use Code16\Sharp\EntityList\Containers\EntityListDataContainer;
use Code16\Sharp\EntityList\EntityListQueryParams;
use Code16\Sharp\EntityList\SharpEntityList;

class PostEntityList extends SharpEntityList
{

    /**
     * Build list containers using ->addDataContainer()
     *
     * @return void
     */
    public function buildListDataContainers()
    {
        $this->addDataContainer(
            EntityListDataContainer::make("client")
                ->setLabel("Client")
        )->addDataContainer(
            EntityListDataContainer::make("title")
                ->setLabel("Titre")
        )->addDataContainer(
            EntityListDataContainer::make("publish_date")
                ->setLabel("Date de publication")
        )->addDataContainer(
            EntityListDataContainer::make("pdf")
                ->setLabel("Pdf")
        );
    }

    /**
     * Build list layout using ->addColumn()
     *
     * @return void
     */
    public function buildListLayout()
    {
        $this->addColumn("publish_date", 2)
            ->addColumn("client", 2)
            ->addColumn("title", 6)
            ->addColumn("pdf", 2);

    }

    /**
     * Build list config
     *
     * @return void
     * @throws \Code16\Sharp\Exceptions\SharpException
     */
    public function buildListConfig()
    {
        $this
            ->setSearchable()
            ->setPaginated()
            ->setEntityState("visibility", PostVisibilityStateHandler::class);
    }

    /**
     * @param EntityListQueryParams $params
     * @return array
     */
    public function getListData(EntityListQueryParams $params)
    {
        $posts = Post::select('*')
            ->orderBy("publish_date","desc");

        if ($params->hasSearch()) {
            foreach ($params->searchWords() as $word) {
                $posts->where(function ($query) use ($word) {
                    $query->orWhere("title", "like", $word)
                        ->orWhere("description", "like", $word);
                });
            }
        }

        return $this
            ->setCustomTransformer("publish_date", function ($value, Post $post) {
                return $post->publish_date->format("d/m/Y");
            })
            ->setCustomTransformer("pdf", function ($value, Post $post) {
                return $post->pdf ? "oui" : "non";
            })
            ->transform($posts->paginate(40));
    }
}
