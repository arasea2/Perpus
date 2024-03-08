import Navbar from '@/Components/Navbar';
import ListBuku from '@/Components/Public/ListBuku';
import { Link, Head } from '@inertiajs/react';
import axios from 'axios';
import { useEffect, useState } from 'react';
import Info from './Public/Info';
import Footer from '@/Components/Footer';

export default function Welcome(props) {
    const [isVisible, noVisible] = useState(true)
    const [infodata, setInfodata] = useState([]);

    const getInfodata = () => {
        axios.get('api/infoboxapi')
            .then(res => [setInfodata(res.data)]);
    }

    useEffect(() => {
        getInfodata()
        const timer = setTimeout(() => {
            noVisible(false);
        }, 10000);

        return () => clearTimeout(timer);
    }, [])


    return (
        <>
            <Head title="Welcome" />
            <div className="min-h-screen">
                <Navbar auth={props.auth} />

                {!props.auth.user && <div className=' m-4'>
                    <div role="alert" className="alert alert-warning shadow-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" className="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>
                        <div>
                            <h3 className="font-bold">Alert!</h3>
                            <div className="text-xs">Mohon Login sebelum menggunakan Aplikasi</div>
                        </div>
                        <div className="flex">
                            <Link href={route('login')} className="btn btn-sm">Login</Link>
                            {/* {/* <div className="divider divider-horizontal">OR</div> */}
                        </div>
                    </div>
                </div>}
                {isVisible && props.flash.message ? <div role="alert" className="alert alert-success my-3">
                    <svg xmlns="http://www.w3.org/2000/svg" className="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    <span>{props.flash.message}</span>
                </div> : ''}

                <div className="mx-10">
                    <Info info={infodata} />
                </div>

                <ListBuku role={props.auth.roles} />

                <Footer />
            </div>
        </>
    );
}
