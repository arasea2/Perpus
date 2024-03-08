import { Link } from "@inertiajs/react"
import axios from "axios"
import { useEffect, useState } from "react"
import InputLabel from "../InputLabel"
import TextInput from "../TextInput"

const ListBuku = ({ role }) => {
    const [buku, setBuku] = useState([])
    const [filter, setFilter] = useState('')

    // console.log(role)

    const getBuku = () => {
        axios.get('api/listBuku')
            .then(res => [setBuku(res.data)])
    }
    // console.log(buku)

    const handleSearch = (e) => {
        setFilter(e.target.value);
    };

    const searchProduct = buku.filter((i) => {
        return i.judul.toLowerCase().includes(filter.toLowerCase())
    })

    useEffect(() => {
        getBuku()
    }, [])
    return (
        <>
            <div className="mt-4 m-5 pt-9">
                <InputLabel htmlFor="caribuku" value="Cari Buku" />
                <TextInput type="text" id="caribuku" placeholder="Type here" className="mt-1 block w-full" value={filter} onChange={handleSearch} />
            </div>
            <div className="flex m-6">
                <div className="min-h-screen flex flex-wrap lg:flex-row flex-col gap-12 m-6">
                    {searchProduct.length > 0 ? searchProduct.map((item) => {
                        return <div key={item.id} className="card w-96 bg-base-100 shadow-xl image-full max-h-72 overflow-hidden">
                            <figure>{!item.image ? <><img className="w-full max-h-80" src="data:image/jpeg;base64,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" alt="Book" /></>
                                : <><img alt="Book" className="w-full max-h-80" src={`/uploads/${item.image}`} /></>}</figure>
                            <div className="card-body">
                                <h2 className="card-title">
                                    {item.judul}
                                    {/* <div className="badge badge-secondary">NEW</div> */}
                                </h2>
                                <p>Penulis : {item.penulis}</p>
                                <p>Penerbit : {item.penerbit}</p>
                                <p>Tahun Terbit : {item.tahun}</p>
                                <p>Stock Tersedia : {item.stock_tersedia}</p>
                                <div className="card-actions justify-end">
                                    <div className="badge badge-outline">{item.kategori}</div>
                                    {/* <div className="badge badge-outline">Products</div> */}
                                </div>
                                <div className="card-actions justify-center pb-3">
                                    {item.stock_tersedia ? <> {role ? <>{role[0].name == 'petugas' ? '' : <Link className="btn" href={`pinjamBuku/${item.id}/${item.judul}`}>Pinjam</Link>}</> : ''} </> : ''}
                                    {/* {auth ? <>{auth.level == 'petugas' ? '' : <Link className="btn" href={`pinjamBuku/${item.id}`}>Pinjam</Link>}</> : ''} */}
                                </div>
                            </div>
                        </div>
                    }) : ''}
                </div >
            </div>
        </>
    )
}

export default ListBuku