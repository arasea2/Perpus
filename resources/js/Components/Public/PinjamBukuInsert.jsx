import GuestLayout from "@/Layouts/GuestLayout"
import { Head, useForm } from "@inertiajs/react"
import InputLabel from "../InputLabel"
import InputError from "../InputError"
import TextInput from "../TextInput"
import PrimaryButton from "../PrimaryButton"
import Swal from "sweetalert2"

const PinjamBukuInsert = ({ props }) => {
    
    const { data, setData, errors, processing, post } = useForm({
        id_user: props.auth.user.id,
        id_buku: props.book.id,
        tglPinjam: '',
        tglKembali: '',
        status: 'diajukan',
    })

    const submit = (e) => {
        e.preventDefault(e)
        post(route('insertPinjam'))
    }
    return (
        <>
            <div className="min-w-screen w-screen flex items-center p-3 absolute">
                {!props.flash.message ? '' : <div role="alert" className="alert alert-error sticky">
                    <svg xmlns="http://www.w3.org/2000/svg" className="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    <span>{props.flash.message}</span>
                </div>}

            </div>
            <GuestLayout>
                <Head title={props.book.judul} />

                <form onSubmit={submit}>
                    <div className="text-4xl text-center">Form Peminjamam Buku</div>

                    <div className="mt-4">
                        <InputLabel htmlFor="name" value="Nama Peminjam" />

                        <TextInput
                            type="text"
                            disabled
                            value={props.auth.user.name}
                            className="mt-1 block w-full"
                        />

                    </div>

                    <div className="mt-4">
                        <InputLabel htmlFor="name" value="Judul Buku" />

                        <TextInput
                            type="text"
                            disabled
                            value={props.book.judul}
                            className="mt-1 block w-full"
                        />

                    </div>

                    <div className="mt-4">
                        <InputLabel htmlFor="tglp" value="Tanggal Pinjam" />

                        <TextInput
                            id="tglp"
                            type="date"
                            name="tglp"
                            value={data.tglPinjam}
                            className="mt-1 block w-full"
                            onChange={(e) => setData('tglPinjam', e.target.value)}
                        />

                        <InputError message={errors.tglPinjam} className="mt-2" />
                    </div>

                    <div className="mt-4">
                        <InputLabel htmlFor="tglk" value="Tanggal Kembali" />
                        <TextInput
                            id="tglk"
                            type="date"
                            name="tglk"
                            value={data.tglKembali}
                            className="mt-1 block w-full"
                            onChange={(e) => setData('tglKembali', e.target.value)}
                        />

                        <InputError message={errors.tglKembali} className="mt-2" />
                    </div>

                    <div className="flex items-center justify-end mt-4">

                        <PrimaryButton className="ms-4">
                            Pinjam
                        </PrimaryButton>
                    </div>
                </form>
            </GuestLayout>
        </>
    )
}

export default PinjamBukuInsert