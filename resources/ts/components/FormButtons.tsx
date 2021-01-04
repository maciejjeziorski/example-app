import React from "react";
import {Link} from "react-router-dom";

export default function FormButtons({cancelPath, cancelLabel = "Cancel", submitLabel = "Submit"}: FormButtonsProps) {
    return (
        <div className="text-end">
            {cancelPath && (
                <Link to={cancelPath} className="btn btn-light ms-2" children={cancelLabel}/>
            )}
            <button type="submit" className="btn btn-primary ms-2" children={submitLabel}/>
        </div>
    );
}

type FormButtonsProps = {
    cancelPath?: string
    cancelLabel?: string,
    submitLabel?: string,
};
