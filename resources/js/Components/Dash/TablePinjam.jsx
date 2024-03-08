import { Head } from "@inertiajs/react"
import axios from "axios"
import { useEffect, useState } from "react"

const TablePinjam = ({ user }) => {
    const [data, setData] = useState('')
    const getDataDipinjam = () => {
        axios.get(`/api/kelompok/dipinjam/${user.user.id}`)
            .then(response => [
                setData(response.data)
            ])
    }

    const getDataKembali = () => {
        axios.get(`/api/kelompok/dikembalikan/${user.user.id}`)
            .then(response => [
                setData(response.data)
            ])
    }

    const getDataDiajukan = () => {
        axios.get(`/api/kelompok/diajukan/${user.user.id}`)
            .then(response => [
                setData(response.data)
            ])
    }

    const getDataDitolak = () => {
        axios.get(`/api/kelompok/ditolak/${user.user.id}`)
            .then(response => [
                setData(response.data)
            ])
    }

    const getData = () => {
        axios.get(`api/listPinjaman/${user.user.id}`)
            .then(response => [
                setData(response.data)
            ])
    }
    useEffect(() => {
        getData()
    }, [])
    return (
        <>
            <Head title="Dashboard" />
            <div className="flex m-3">
                <button className="btn m-3 w-44" onClick={getData}>All</button>
                <button className="btn btn-warning m-3 w-44" onClick={getDataDiajukan}>Diajukan</button>
                <button className="btn btn-error m-3 w-44" onClick={getDataDitolak}>Ditolak</button>
                <button className="btn btn-success m-3 w-44" onClick={getDataDipinjam}>Dipinjam</button>
                <button className="btn btn-info m-3 w-44" onClick={getDataKembali}>Dikembalikan</button>
            </div>
            <div className="overflow-x-auto">
                <table className="table">
                    {/* head */}
                    <thead>
                        <tr>
                            <th>Id Pinjaman</th>
                            <th>Judul</th>
                            <th>Tanggal Pinjam</th>
                            <th>Tanggal Kembali</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        {data ? data.map((data) => {
                            return <tr key={data.id} className="bg-base-200">
                                <th>{data.id}</th>
                                <td>{data.book.judul}</td>
                                <td>{data.tglPinjam}</td>
                                <td>{data.tglKembali}</td>
                                <td>{data.status}</td>
                            </tr>
                        }) : <tr><td></td></tr>}
                    </tbody>
                </table>
            </div >
        </>
    )
}
export default TablePinjam