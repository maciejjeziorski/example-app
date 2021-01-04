import React from "react";

export default function Content({page: RenderedPage}) {
    return (
        <div className="container my-5">
            <RenderedPage/>
        </div>
    );
}
