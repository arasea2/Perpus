import { Link } from "@inertiajs/react"
import axios from "axios"
import { useEffect, useState } from "react"

const Navbar = ({ auth }) => {
    const [data, setData] = useState([])
    const getData = () => {
        {
            auth.user ? axios.get(`api/cartinfo/${auth.user.id}/get`)
                .then(res => [setData(res.data)]) : ''
        }


    }

    useEffect(() => {
        getData()
    }, [])
    
    return (

        <div className="navbar bg-neutral mb-3">
            <div className="flex-1">
                <a className="btn btn-ghost text-xl">Perpusda</a>
            </div>
            <div className="flex-none">
                <div className="dropdown dropdown-end">
                    <div tabIndex={0} role="button" className="btn btn-ghost btn-circle">
                        <div className="indicator">
                            <svg xmlns="http://www.w3.org/2000/svg" className="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
                            <span className="badge badge-sm indicator-item">{auth.user ? <div>{data.dipinjam}</div> : <div>0</div>}</span>
                        </div>
                    </div>
                    <div tabIndex={0} className="mt-3 z-[1] card card-compact dropdown-content w-52 bg-base-100 shadow">
                        <div className="card-body">
                            <span className="font-bold text-lg flex">{auth.user ? <div className=" pr-2">{data.data}</div> : <div className="pr-2">0</div>} Buku Total</span>
                            {/* <span className="text-info">Subtotal: $999</span> */}
                            <div className="card-actions">
                                <Link className="btn btn-primary btn-block" href="/dashboard">Lihat List</Link>
                            </div>
                        </div>
                    </div>
                </div>
                <div className="dropdown dropdown-end">
                    <div tabIndex={0} role="button" className="btn btn-ghost">
                        <div className=" full">
                            <span>{auth.user ? <div>{auth.user.name}</div> : <div>Guest</div>}</span>
                            {/* <img alt="Tailwind CSS Navbar component" src="https://daisyui.com/images/stock/photo-1534528741775-53994a69daeb.jpg" /> */}
                        </div>
                    </div>
                    <ul tabIndex={0} className="menu menu-sm dropdown-content mt-3 z-[1] p-2 shadow bg-base-100 rounded-box w-52">
                        {auth.user ?
                            <>
                                <li>{auth.roles[0].slug == 'peminjam' ? <Link href='/dashboard'>Dashboard</Link> : ''}</li>
                                <li><Link href={route('logout')} method='post' as='button'>Log Out</Link></li> </> :
                            <li><Link href={route('login')} >Login</Link></li>}
                    </ul>
                </div>
            </div>
        </div>
    )
}

export default Navbar