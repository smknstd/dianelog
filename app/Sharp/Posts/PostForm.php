<?php

namespace App\Sharp\Posts;

use App\Models\Post;
use Code16\Sharp\Form\Eloquent\Transformers\FormUploadModelTransformer;
use Code16\Sharp\Form\Eloquent\WithSharpFormEloquentUpdater;
use Code16\Sharp\Form\Fields\SharpFormDateField;
use Code16\Sharp\Form\Fields\SharpFormTextField;
use Code16\Sharp\Form\Fields\SharpFormUploadField;
use Code16\Sharp\Form\Layout\FormLayoutColumn;
use Code16\Sharp\Form\SharpForm;

class PostForm extends SharpForm
{
    use WithSharpFormEloquentUpdater;

    /**
     * Build form fields using ->addField()
     *
     * @return void
     */
    public function buildFormFields()
    {
        $this->addField(
            SharpFormUploadField::make("pdf")
                ->setLabel("Pdf")
                ->setStorageBasePath("data/sharp/posts/{id}")
                ->setFileFilter(["pdf"])
                ->setMaxFileSize(4)
        )->addField(
            SharpFormTextField::make("title")
                ->setMaxLength(200)
                ->setLabel("Titre")
        )->addField(
            SharpFormTextField::make("link")
                ->setLabel("Lien")
        )->addField(
            SharpFormTextField::make("client")
                ->setLabel("Client")
        )->addField(
            SharpFormTextField::make("description")
                ->setLabel("Notes")
                ->setHelpMessage("Facultatif")
        )->addField(
            SharpFormDateField::make("publish_date")
                ->setDisplayFormat("DD/MM/YYYY")
                ->setLabel("Date de publication")
                ->setHelpMessage("Les publications sont affichées anti-chronologiquement selon cette date.")
        );
    }

    /**
     * Build form layout using ->addTab() or ->addColumn()
     *
     * @return void
     */
    public function buildFormLayout()
    {
        $this->addColumn(5, function (FormLayoutColumn $column) {
            $column
                ->withSingleField("title")
                ->withSingleField("description")
                ->withSingleField("client")
                ->withSingleField("publish_date");
        })->addColumn(7, function (FormLayoutColumn $column) {
            $column
                ->withSingleField("link")
                ->withSingleField("pdf");
        });
    }

    /**
     * Retrieve a Model for the form and pack all its data as JSON.
     *
     * @param $id
     * @return array
     */
    public function find($id): array
    {
        return $this
            ->setCustomTransformer("pdf", new FormUploadModelTransformer())
            ->transform(Post::findOrFail($id));
    }

    /**
     * @param $id
     * @param array $data
     * @return mixed
     */
    public function update($id, array $data)
    {
        $post = $id
            ? Post::findOrFail($id)
            : new Post([
                "visibility" => Post::$offline,
            ]);

        $this->save($post, $data);

        return $post->id;
    }

    public function delete($id)
    {
        Post::findOrFail($id)
            ->delete();
    }
}
