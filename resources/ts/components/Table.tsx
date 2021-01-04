import React from "react";

export default function Table({head, body}) {
    return (
        <table className="table table-bordered my-3">
            <thead>
            <tr>
                {head.map((params, key) => (
                    <th key={key} {...params}/>
                ))}
            </tr>
            </thead>
            <tbody children={body} className="align-middle"/>
        </table>
    );
}
