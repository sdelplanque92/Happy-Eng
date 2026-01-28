import { registerBlockType } from "@wordpress/blocks";
import {
    useBlockProps,
    InnerBlocks,
    InspectorControls,
    RichText,
    MediaUpload,
    MediaUploadCheck
} from "@wordpress/block-editor";
import { PanelBody, Button, TextControl } from "@wordpress/components";

const emptyItem = () => ({ text: "" });

registerBlockType("he/text-bullets-image", {
    edit: ({ attributes, setAttributes }) => {
        const { title, text, mediaId, mediaUrl, mediaAlt } = attributes;
        const items = Array.isArray(attributes.items) ? attributes.items : [emptyItem()];

        const blockProps = useBlockProps({ className: "he-tbi-editor" });

        const setItemText = (index, value) => {
            const next = items.map((it, i) => (i === index ? { ...it, text: value } : it));
            setAttributes({ items: next });
        };

        const addItem = () => setAttributes({ items: [...items, emptyItem()] });

        const removeItem = (index) => {
            const next = items.filter((_, i) => i !== index);
            setAttributes({ items: next.length ? next : [emptyItem()] });
        };

        const onSelectImage = (media) => {
            setAttributes({
                mediaId: media?.id || 0,
                mediaUrl: media?.url || "",
                mediaAlt: media?.alt || ""
            });
        };

        return (
            <>
                <InspectorControls>
                    <PanelBody title="Image">
                        <TextControl
                            label="Texte alternatif (alt)"
                            value={mediaAlt}
                            onChange={(v) => setAttributes({ mediaAlt: v })}
                            help="Accessibilité & SEO."
                        />
                        {mediaUrl ? (
                            <Button
                                variant="secondary"
                                onClick={() => setAttributes({ mediaId: 0, mediaUrl: "", mediaAlt: "" })}
                            >
                                Retirer l’image
                            </Button>
                        ) : null}
                    </PanelBody>

                    <PanelBody title="Liste à puces" initialOpen={false}>
                        <Button variant="primary" onClick={addItem}>
                            + Ajouter un point
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
                                    <RichText
                                        tagName="p"
                                        placeholder={`Point ${idx + 1}… (Entrée = retour à la ligne)`}
                                        value={it.text}
                                        onChange={(v) => setItemText(idx, v)}
                                        allowedFormats={["core/bold", "core/italic", "core/link"]}
                                    />
                                    <Button variant="secondary" onClick={() => removeItem(idx)}>
                                        Supprimer ce point
                                    </Button>
                                </div>
                            ))}
                        </div>
                    </PanelBody>
                </InspectorControls>

                <section {...blockProps}>
                    <div className="he-tbi__container">
                        <RichText
                            tagName="h2"
                            className="he-tbi__title"
                            placeholder="Titre…"
                            value={title}
                            onChange={(v) => setAttributes({ title: v })}
                            allowedFormats={[]}
                        />

                        <RichText
                            tagName="p"
                            className="he-tbi__text"
                            placeholder="Texte… (Entrée = retour à la ligne)"
                            value={text}
                            onChange={(v) => setAttributes({ text: v })}
                            allowedFormats={["core/bold", "core/italic", "core/link"]}
                        />

                        <div className="he-tbi__row">
                            <div className="he-tbi__left">
                                <InnerBlocks
                                    allowedBlocks={["he/bullet-list"]}
                                    template={[
                                        ["he/bullet-list"]
                                    ]}
                                    templateLock="all"
                                />
                            </div>

                            <div className="he-tbi__right">
                                <MediaUploadCheck>
                                    <MediaUpload
                                        onSelect={onSelectImage}
                                        allowedTypes={["image"]}
                                        value={mediaId}
                                        render={({open}) => (
                                            <div>
                                                {mediaUrl ? (
                                                    <>
                                                        <img className="he-tbi__img" src={mediaUrl}
                                                             alt={mediaAlt || ""}/>
                                                        <div style={{marginTop: 8}}>
                                                            <Button variant="primary" onClick={open}>
                                                                Changer l’image
                                                            </Button>
                                                        </div>
                                                    </>
                                                ) : (
                                                    <Button variant="primary" onClick={open}>
                                                        Choisir une image
                                                    </Button>
                                                )}
                                            </div>
                                        )}
                                    />
                                </MediaUploadCheck>
                            </div>
                        </div>
                    </div>
                </section>
            </>
        );
    },

    save: () => {
        return <InnerBlocks.Content />;
    }
});
