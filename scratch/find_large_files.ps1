$folders = @('app', 'resources/views')
$folders | ForEach-Object {
    Get-ChildItem -Path $_ -Recurse -Include *.php,*.blade.php | 
        Where-Object { $_.FullName -notmatch 'vendor|node_modules|storage' } | 
        ForEach-Object { 
            try {
                $content = Get-Content $_.FullName -ErrorAction SilentlyContinue
                if ($content) {
                    $lines = $content.Count
                    [PSCustomObject]@{Path=$_.FullName; Lines=$lines}
                }
            } catch {}
        }
} | 
Sort-Object Lines -Descending | 
Select-Object -First 30 |
ConvertTo-Json
