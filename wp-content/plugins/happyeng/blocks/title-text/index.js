import { registerBlockType } from "@wordpress/blocks";
import { useBlockProps, RichText } from "@wordpress/block-editor";

registerBlockType("he/title-text", {
    edit: ({ attributes, setAttributes }) => {
        const { title, text } = attributes;
        const blockProps = useBlockProps({ className: "he-title-text-editor" });

        return (
            <section {...blockProps}>
                <RichText
                    tagName="h2"
                    className="he-title-text__title"
                    placeholder="Titre…"
                    value={title}
                    onChange={(v) => setAttributes({ title: v })}
                    allowedFormats={[]}
                />

                <RichText
                    tagName="p"
                    className="he-title-text__text"
                    placeholder="Texte… (Entrée = retour à la ligne)"
                    value={text}
                    onChange={(v) => setAttributes({ text: v })}
                    allowedFormats={["core/bold", "core/italic", "core/link"]}
                />
            </section>
        );
    },

    save: () => null // bloc dynamique
});
