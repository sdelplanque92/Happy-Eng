import { registerBlockType } from "@wordpress/blocks";
import { useBlockProps } from "@wordpress/block-editor";

registerBlockType("he/latest-posts-3", {
    edit: () => {
        const blockProps = useBlockProps();

        return (
            <div {...blockProps}>
                <strong>3 derniers articles</strong>
                <p style={{ marginTop: 8, opacity: 0.8 }}>
                    Ce bloc affiche automatiquement les 3 derniers posts publiés.
                </p>
            </div>
        );
    },
    save: () => null // dynamique => rendu PHP
});
