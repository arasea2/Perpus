<?php

namespace App\Admin\Controllers;

use App\Models\Buku;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Encore\Admin\Grid\Filter;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Controllers\AdminController;

class BukuController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Buku';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Buku());

        $grid->column('id', __('Id'));
        $grid->column('judul', __('Judul'));
        $grid->column('penulis', __('Penulis'));
        $grid->column('penerbit', __('Penerbit'));
        $grid->column('tahun', __('Tahun'));
        $grid->column('kategori', __('Kategori'));
        $grid->column('dstock', __('Dstock'));
        $grid->column('stockTersedia', __('Tersedia'))->display(function () {
            return $this->stockTersedia();
        });
        $grid->column('image', 'Sampul')->image();

        if(Admin::user()->isRole('admin')){
            $grid->disableActions();
            $grid->disableCreateButton();
        }

        $grid->filter(function(Filter $filter) {
            $filter->like('judul', 'Judul Buku');
            $filter->in('kategori', 'Kategori')->multipleSelect([
                'fiksi' => 'Fiksi',
                'non fiksi' => 'Non Fiksi',
                'komik' => 'Komik'
            ]);

        });

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Buku::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('judul', __('Judul'));
        $show->field('penulis', __('Penulis'));
        $show->field('penerbit', __('Penerbit'));
        $show->field('tahun', __('Tahun'));
        $show->field('kategori', __('Kategori'));
        $show->field('dstock', __('Dstock'));
        $show->field('image', __('Gambar'))->image();
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Buku());

        $form->text('judul', __('Judul'));
        $form->text('penulis', __('Penulis'));
        $form->text('penerbit', __('Penerbit'));
        $form->year('tahun', __('Tahun'));
        $form->select('kategori', __('Kategori'))->options(['fiksi' => 'Fiksi', 'non fiksi' => 'Non Fiksi', 'komik' => 'Komik']);
        $form->number('dstock', __('Dstock'));
        $form->image('image', 'Gambar Buku')->move('/bukusImage')->uniqueName();

        return $form;
    }
}
