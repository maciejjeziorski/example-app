import React from "react";

export default function SelectInput({name, register: ref, error, options = []}: TextInputProps) {
    const hasError = !!error;
    const children = options.map((option, key) => (
        <option key={key} {...option}/>
    ));

    return (
        <>
            <select className={"form-control" + (hasError ? " is-invalid" : "")}
                    {...{name, ref, children}}
            />

            {hasError && (
                <div className="invalid-feedback" children={error}/>
            )}
        </>
    );
}

type Option = {
    value: string | number | null,
    children: string | number | null,
}

type TextInputProps = {
    name: string,
    register: unknown,
    options: Array<Option>,
    error: string | null,
};
