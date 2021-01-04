import React from "react";

export default function Pagination({links, handleClick}: PaginationProps) {
    return (
        <nav>
            {links.length > 3 && (
                <ul className="pagination justify-content-center">
                    {links.map(({url, label, active}, key) => (
                        <li className={"page-item" + (active ? " active" : "") + (url === null ? " disabled" : "")}
                            key={key}>
                            <a className="page-link"
                               dangerouslySetInnerHTML={{__html: label}}
                               href="#"
                               onClick={() => {
                                   if (url !== null) handleClick(url);
                               }}
                            />
                        </li>
                    ))}
                </ul>
            )}
        </nav>
    );
}

type LinkType = {
    url: string | null,
    label: string | number,
    active: boolean,
};

type PaginationProps = {
    links: LinkType[],
    handleClick: (string) => void,
}
