import { registerBlockType } from "@wordpress/blocks";
import { useBlockProps, RichText } from "@wordpress/block-editor";
import { Button } from "@wordpress/components";

const emptyItem = () => ({ text: "" });

registerBlockType("he/bullet-list", {
    edit: ({ attributes, setAttributes }) => {
        const { title, items = [] } = attributes;
        const blockProps = useBlockProps({ className: "he-bullets-editor" });

        const setItemText = (index, value) => {
            const next = items.map((it, i) => (i === index ? { ...it, text: value } : it));
            setAttributes({ items: next });
        };

        const addItem = () => setAttributes({ items: [...items, emptyItem()] });

        const removeItem = (index) => {
            const next = items.filter((_, i) => i !== index);
            setAttributes({ items: next.length ? next : [emptyItem()] });
        };

        return (
            <section {...blockProps}>
                <RichText
                    tagName="h2"
                    className="he-bullets__title"
                    placeholder="Titre (optionnel)…"
                    value={title}
                    onChange={(v) => setAttributes({ title: v })}
                    allowedFormats={[]}
                />

                <ul className="he-bullets__list">
                    {(items.length ? items : [emptyItem()]).map((it, idx) => (
                        <li className="he-bullets__item" key={idx}>
                            <RichText
                                tagName="p"
                                placeholder="Écris un point… (Entrée = retour ligne)"
                                value={it.text}
                                onChange={(v) => setItemText(idx, v)}
                            />
                            <Button
                                variant="secondary"
                                onClick={() => removeItem(idx)}
                                style={{ marginLeft: 8 }}
                            >
                                Supprimer
                            </Button>
                        </li>
                    ))}
                </ul>

                <Button variant="primary" onClick={addItem}>
                    + Ajouter un point
                </Button>
            </section>
        );
    },

    save: () => null // bloc dynamique => rendu PHP
});
