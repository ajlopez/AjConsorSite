<#
Sub CopyDirectory(from,to)
	Message "From Directory " & from
	Message "To Directory " & to
	
	fromdir = new System.IO.DirectoryInfo("Libraries")
	Message "FromDir"
	todir = new System.IO.DirectoryInfo(to.ToString())
	Message "ToDir"
	
	'for each fi in fromdir.GetFiles()
	'	Message "Copying " & fi.FullName & " to " & System.IO.Path.Combine(from, fi.Name)
	'end for
End Sub
#>