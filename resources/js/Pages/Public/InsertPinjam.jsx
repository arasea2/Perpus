import PinjamBukuInsert from "@/Components/Public/PinjamBukuInsert";
import { Head } from "@inertiajs/react";

export default function InsertPeminjaman(props) {
    return (
        <>
            {/* <Head title={props.book.judul} /> */}
            <PinjamBukuInsert props={props} />
        </>
    )
}