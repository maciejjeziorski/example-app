import React from "react";

export default function Header({title}: HeaderProps) {
    return (
        <h1 className="display-4 text-muted mb-4" children={title}/>
    );
}

type HeaderProps = {
    title: string,
};
