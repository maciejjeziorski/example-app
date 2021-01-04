import React from "react";

export default function Home() {
    return (
        <>
            <h2 className="h4">App details</h2>
            <ul>
                <li>Simple application with client- and admin- panels.</li>
                <li>CRUD for projects and tasks.</li>
                <li>API in Laravel, frontend in React.</li>
                <li>PHPUnit tests 70%.</li>
            </ul>

            <h2 className="h4">Author</h2>
            <p>
                Maciej Jeziorski, 01/2021.
            </p>
        </>
    );
}
