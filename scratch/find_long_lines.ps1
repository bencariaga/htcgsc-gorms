Get-ChildItem -Path . -Recurse -Filter *.php | 
    Where-Object { $_.FullName -notmatch 'vendor|node_modules|storage|_ide_helper' } | 
    ForEach-Object { 
        try {
            $content = Get-Content $_.FullName -ErrorAction SilentlyContinue
            if ($content) {
                $maxLineLength = ($content | ForEach-Object { $_.Length } | Measure-Object -Maximum).Maximum
                if ($maxLineLength -gt 120) {
                    [PSCustomObject]@{Path=$_.FullName; MaxLineLength=$maxLineLength}
                }
            }
        } catch {}
    } | 
    Sort-Object MaxLineLength -Descending | 
    Select-Object -First 30 |
    ConvertTo-Json
