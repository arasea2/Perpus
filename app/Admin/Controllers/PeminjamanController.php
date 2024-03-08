<?php

namespace App\Admin\Controllers;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use App\Models\Peminjaman;
use Encore\Admin\Grid\Filter;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Controllers\AdminController;

class PeminjamanController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Peminjaman';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Peminjaman());

        $grid->column('id', __('Id'))->sortable();
        $grid->column('getUsrname.username', __('Id user'));
        $grid->column('Book.judul', __('Id buku'));
        $grid->column('tglPinjam', __('TglPinjam'));
        $grid->column('tglKembali', __('TglKembali'));
        if(Admin::user()->isRole('petugas')) {
            $grid->column('status', __('Status pinjam'))->radio([
                'diajukan' => 'Diajukan',
                'ditolak' => 'Ditolak',
                'dipinjam' => 'Dipinjam',
                'dikembalikan' => 'Dikembalikan',
            ]);
        } else {
            $grid->column('status', __('Status pinjam'));
        }

        if (Admin::user()->isRole('petugas')) {
            $grid->disableCreateButton();
        }
        if (Admin::user()->isRole('admin')) {
            $grid->disableActions();
            $grid->disableCreateButton();
        }

        $grid->export(function ($export) {
            $export->originalValue(['status_pinjam']);
        });

        $grid->filter(function (Filter $filter) {
            $filter->in('status', 'Status')->select([
                'diajukan' => 'Diajukan',
                'ditolak' => 'Ditolak',
                'dipinjam' => 'Dipinjam',
                'dikembalikan' => 'Dikembalikan',
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
        $show = new Show(Peminjaman::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('id_user', __('Id user'));
        $show->field('id_buku', __('Id buku'));
        $show->field('tglPinjam', __('TglPinjam'));
        $show->field('tglKembali', __('TglKembali'));
        $show->field('status', __('Status'));
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
        $form = new Form(new Peminjaman());

        $form->text('id_user', __('Id user'));
        $form->text('id_buku', __('Id buku'));
        $form->date('tglPinjam', __('TglPinjam'))->default(date('Y-m-d'));
        $form->date('tglKembali', __('TglKembali'))->default(date('Y-m-d'));
        $form->text('status', __('Status'));

        return $form;
    }
}
