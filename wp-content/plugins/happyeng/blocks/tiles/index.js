import { registerBlockType } from "@wordpress/blocks";
import { useBlockProps, InspectorControls } from "@wordpress/block-editor";
import { PanelBody, Button, TextControl, TextareaControl } from "@wordpress/components";

const emptyItem = () => ({ url: "", icon: "", title: "", text: "" });

registerBlockType("he/tiles", {
    edit: ({ attributes, setAttributes }) => {
        const items = Array.isArray(attributes.items) ? attributes.items : [emptyItem()];
        const blockProps = useBlockProps({ className: "he-tiles-editor" });

        const setItem = (index, patch) => {
            const next = items.map((it, i) => (i === index ? { ...it, ...patch } : it));
            setAttributes({ items: next });
        };

        const addItem = () => setAttributes({ items: [...items, emptyItem()] });

        const removeItem = (index) => {
            const next = items.filter((_, i) => i !== index);
            setAttributes({ items: next.length ? next : [emptyItem()] });
        };

        return (
            <>
                <InspectorControls>
                    <PanelBody title="Tiles">
                        <Button variant="primary" onClick={addItem}>
                            + Ajouter une tuile
                        </Button>

                        <div style={{ marginTop: 12 }}>
                            {items.map((it, idx) => (
                                <div
                                    key={idx}
                                    style={{
                                        borderTop: idx ? "1px solid #ddd" : "none",
                                        paddingTop: idx ? 12 : 0,
                                        marginTop: idx ? 12 : 0
                                    }}
                                >
                                    <TextControl
                                        label={`Tuile ${idx + 1} — Lien (URL)`}
                                        value={it.url || ""}
                                        onChange={(v) => setItem(idx, { url: v })}
                                        placeholder="/page/ ou https://…"
                                    />
                                    <TextControl
                                        label={`Tuile ${idx + 1} — Icon (nom machine)`}
                                        value={it.icon || ""}
                                        onChange={(v) => setItem(idx, { icon: v })}
                                        placeholder="server, cloud, cpu…"
                                        help="Ce champ sert à appliquer une classe (ex: he-icon--server)."
                                    />
                                    <TextControl
                                        label={`Tuile ${idx + 1} — Titre`}
                                        value={it.title || ""}
                                        onChange={(v) => setItem(idx, { title: v })}
                                    />
                                    <TextareaControl
                                        label={`Tuile ${idx + 1} — Texte`}
                                        value={it.text || ""}
                                        onChange={(v) => setItem(idx, { text: v })}
                                    />

                                    <Button variant="secondary" onClick={() => removeItem(idx)}>
                                        Supprimer cette tuile
                                    </Button>
                                </div>
                            ))}
                        </div>
                    </PanelBody>
                </InspectorControls>

                <section {...blockProps}>
                    <div className="he-tiles__container">
                        <div className="he-tiles__grid">
                            {items.map((it, idx) => (
                                <div className="he-tile" key={idx} style={{ padding: 16, border: "1px solid #ddd", borderRadius: 12 }}>
                                    <div style={{ fontSize: 12, opacity: 0.7 }}>
                                        icon: <code>{it.icon || "—"}</code>
                                    </div>
                                    <div style={{ fontWeight: 700, marginTop: 6 }}>{it.title || "Titre…"}</div>
                                    <div style={{ marginTop: 6, opacity: 0.9 }}>{it.text || "Texte…"}</div>
                                    <div style={{ marginTop: 10, fontSize: 12, opacity: 0.7 }}>
                                        {it.url ? `→ ${it.url}` : "URL manquante"}
                                    </div>
                                </div>
                            ))}
                        </div>
                    </div>
                </section>
            </>
        );
    },

    save: () => null // bloc dynamique => rendu PHP
});
