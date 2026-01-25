import { registerBlockType } from "@wordpress/blocks";
import {
    useBlockProps,
    InspectorControls,
    RichText
} from "@wordpress/block-editor";
import { PanelBody, TextControl } from "@wordpress/components";

const ensure3Buttons = (buttons) => {
    const b = Array.isArray(buttons) ? [...buttons] : [];
    while (b.length < 3) b.push({ label: "", url: "" });
    return b.slice(0, 3);
};

registerBlockType("he/hero-composition", {
    edit: ({ attributes, setAttributes }) => {
        const { heading2, heading3, text } = attributes;
        const buttons = ensure3Buttons(attributes.buttons);

        const blockProps = useBlockProps({ className: "he-hero-editor" });

        const setButton = (idx, patch) => {
            const next = buttons.map((b, i) => (i === idx ? { ...b, ...patch } : b));
            setAttributes({ buttons: next });
        };

        return (
            <>
                <InspectorControls>
                    <PanelBody title="Boutons (3)">
                        {buttons.map((b, idx) => (
                            <div key={idx} style={{ borderTop: idx ? "1px solid #ddd" : "none", paddingTop: idx ? 12 : 0, marginTop: idx ? 12 : 0 }}>
                                <TextControl
                                    label={`Bouton ${idx + 1} — Texte`}
                                    value={b.label || ""}
                                    onChange={(v) => setButton(idx, { label: v })}
                                />
                                <TextControl
                                    label={`Bouton ${idx + 1} — URL`}
                                    value={b.url || ""}
                                    onChange={(v) => setButton(idx, { url: v })}
                                    placeholder="https://… ou /page/"
                                />
                            </div>
                        ))}
                    </PanelBody>
                </InspectorControls>

                <section {...blockProps}>
                    <div className="he-hero__container">
                        <RichText
                            tagName="h2"
                            className="he-hero__h2"
                            placeholder="Titre H2…"
                            value={heading2}
                            onChange={(v) => setAttributes({ heading2: v })}
                            allowedFormats={[]}
                        />

                        <RichText
                            tagName="h3"
                            className="he-hero__h3"
                            placeholder="Titre H3…"
                            value={heading3}
                            onChange={(v) => setAttributes({ heading3: v })}
                            allowedFormats={[]}
                        />

                        <RichText
                            tagName="p"
                            className="he-hero__text"
                            placeholder="Texte… (Entrée = retour à la ligne)"
                            value={text}
                            onChange={(v) => setAttributes({ text: v })}
                            // optionnel : limiter les formats
                            allowedFormats={["core/bold", "core/italic", "core/link"]}
                        />

                        <div className="he-hero__buttons">
                            {buttons.map((b, idx) =>
                                    b.label ? (
                                        <span className="he-btn" key={idx}>
                    {b.label}
                  </span>
                                    ) : null
                            )}
                        </div>
                    </div>
                </section>
            </>
        );
    },

    save: () => null // bloc dynamique => rendu PHP
});
