// components/ui/form/icon-select-field.tsx
import { ChevronDown } from "lucide-react";
import * as React from "react";
import DashboardSquare01Icon from "virtual:icons/hugeicons/dashboard-square-01";
import { Button } from "#/components/button.tsx";
import { categoryIcons } from "#/components/category-icon.tsx";
import * as Popover from "#/components/ui/popover.tsx";

type IconSelectFieldProps = {
    value?: string;
    onValueChange: (value: string) => void;
    error?: string;
    disabled?: boolean;
};

export function IconSelectField({ value, onValueChange, error, disabled }: IconSelectFieldProps) {
    const [open, setOpen] = React.useState(false);

    const iconKeys = Object.keys(categoryIcons) as Array<keyof typeof categoryIcons>;

    // Simple search state
    const [search, setSearch] = React.useState("");

    const filteredIcons = React.useMemo(() => {
        if (!search) return iconKeys;
        const term = search.toLowerCase();
        return iconKeys.filter((key) => key.toLowerCase().includes(term));
    }, [search, iconKeys]);

    return (
        <div className="flex flex-col gap-1.5">
            <label className="text-sm text-foreground font-medium">Icon</label>
            <Popover.Root onOpenChange={setOpen} open={open && !disabled}>
                <Popover.Trigger asChild>
                    <Button $size="sm" $style="stroke" $type="neutral" className="justify-between" disabled={disabled}>
                        {value && categoryIcons[value as keyof typeof categoryIcons] ? (
                            React.createElement(categoryIcons[value as keyof typeof categoryIcons], {
                                className: "h-4 w-4",
                            })
                        ) : (
                            <DashboardSquare01Icon className="h-4 w-4 opacity-50" />
                        )}
                        <span className="ml-2 truncate">{value ? value.replace(/-/g, " ") : "Select an icon"}</span>
                        <ChevronDown className="h-4 w-4 opacity-50" />
                    </Button>
                </Popover.Trigger>

                <Popover.Content
                    align="end"
                    className="rounded-md max-h-80 w-64 overflow-hidden border bg-black p-2 shadow-lg"
                    sideOffset={5}
                >
                    <input
                        autoFocus
                        className="border-input bg-background text-xs focus:ring-ring mx-auto mt-1 mb-2 block w-50 items-center border px-1"
                        onChange={(e) => setSearch(e.target.value)}
                        placeholder="Search icons..."
                        type="text"
                        value={search}
                    />
                    {filteredIcons.length === 0 ? (
                        <div className="text-sm text-muted-foreground py-2 text-center">No icons found.</div>
                    ) : (
                        <div className="grid max-h-60 grid-cols-6 gap-1 overflow-y-auto">
                            {filteredIcons.map((key) => {
                                const IconComponent = categoryIcons[key];
                                return (
                                    <button
                                        className={`rounded-md hover:bg-muted flex h-9 w-9 items-center justify-center transition-colors ${
                                            value === key ? "bg-accent" : ""
                                        }`}
                                        key={key}
                                        onClick={() => {
                                            onValueChange(key);
                                            setOpen(false);
                                            setSearch("");
                                        }}
                                        title={key.replace(/-/g, " ")}
                                        type="button"
                                    >
                                        <IconComponent className="h-4 w-4" />
                                    </button>
                                );
                            })}
                        </div>
                    )}
                </Popover.Content>
            </Popover.Root>

            {error ? <p className="text-sm text-destructive">{error}</p> : null}
        </div>
    );
}
