const Info = ({info}) => {
    return (
        <>
            <div className="flex w-full justify-between">
                <div className="bg-blue-100 w-40 border-t border-b border-blue-500 text-blue-700 px-4 py-3" role="alert">
                    <p className="font-bold">Total User : </p>
                    <p className="text-4xl">{info.user}</p>
                </div>
                <div className="divider divider-horizontal"></div>
                <div className="bg-blue-100 w-40 border-t border-b border-blue-500 text-blue-700 px-4 py-3" role="alert">
                    <p className="font-bold">Total Buku : </p>
                    <p className="text-4xl">{info.buku}</p>
                </div>
                <div className="divider divider-horizontal"></div>
                <div className="bg-blue-100 w-40 border-t border-b border-blue-500 text-blue-700 px-4 py-3" role="alert">
                    <p className="font-bold">Total Response : </p>
                    <p className="text-4xl">{info.response}</p>
                </div>
            </div>
        </>
    )
}

export default Info